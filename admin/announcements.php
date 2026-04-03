<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add']) || isset($_POST['edit'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $type = $_POST['type'];
        $priority = $_POST['priority'];
        $start_date = $_POST['start_date'] ?: null;
        $end_date = $_POST['end_date'] ?: null;
        $id = $_POST['id'] ?? null;
        
        // Handle image upload
        $image_path = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "../uploads/announcements/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $image_name = time() . '_' . basename($_FILES['image']['name']);
            $target_file = $target_dir . $image_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = 'uploads/announcements/' . $image_name;
            }
        }
        
        if (isset($_POST['add'])) {
            // Insert new announcement
            $stmt = $conn->prepare("
                INSERT INTO announcements (title, content, type, priority, start_date, end_date, image_path, created_by) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$title, $content, $type, $priority, $start_date, $end_date, $image_path, $_SESSION['admin_id']]);
            $msg = 'added';
        } else {
            // Update existing announcement
            if ($image_path) {
                // With new image
                $stmt = $conn->prepare("
                    UPDATE announcements 
                    SET title=?, content=?, type=?, priority=?, start_date=?, end_date=?, image_path=?
                    WHERE id=?
                ");
                $stmt->execute([$title, $content, $type, $priority, $start_date, $end_date, $image_path, $id]);
            } else {
                // Without new image
                $stmt = $conn->prepare("
                    UPDATE announcements 
                    SET title=?, content=?, type=?, priority=?, start_date=?, end_date=?
                    WHERE id=?
                ");
                $stmt->execute([$title, $content, $type, $priority, $start_date, $end_date, $id]);
            }
            $msg = 'updated';
        }
    } elseif (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM announcements WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $msg = 'deleted';
    }
    
    header("Location: announcements.php?msg=$msg");
    exit();
}

// Fetch all announcements
$announcements = $conn->query("
    SELECT a.*, u.username as created_by_name 
    FROM announcements a 
    LEFT JOIN admin_users u ON a.created_by = u.id 
    ORDER BY 
        CASE priority 
            WHEN 'urgent' THEN 1 
            WHEN 'high' THEN 2 
            WHEN 'normal' THEN 3 
            WHEN 'low' THEN 4 
        END,
        a.created_at DESC
")->fetchAll();

$success_msg = '';
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'added') $success_msg = 'Announcement added successfully!';
    if ($_GET['msg'] == 'updated') $success_msg = 'Announcement updated successfully!';
    if ($_GET['msg'] == 'deleted') $success_msg = 'Announcement deleted successfully!';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Announcements - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }
        
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #2c3e50 0%, #1e2b38 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header i {
            font-size: 3rem;
            color: #f39c12;
            margin-bottom: 10px;
        }
        
        .sidebar-header h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .sidebar-header p {
            font-size: 12px;
            opacity: 0.7;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            gap: 12px;
            transition: all 0.3s;
        }
        
        .menu-item:hover, .menu-item.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left: 4px solid #f39c12;
        }
        
        .menu-item i {
            width: 20px;
        }
        
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 30px;
        }
        
        .top-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .page-title h2 {
            color: #2c3e50;
            font-size: 24px;
        }
        
        .page-title p {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .add-btn {
            background: #27ae60;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .add-btn:hover {
            background: #229954;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px 25px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            overflow-y: auto;
            padding: 20px;
        }
        
        .modal-content {
            background: white;
            width: 90%;
            max-width: 700px;
            margin: 30px auto;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            animation: modalSlideIn 0.3s ease;
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .modal-header h3 {
            color: #2c3e50;
            font-size: 22px;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #7f8c8d;
            transition: color 0.3s;
        }
        
        .close-btn:hover {
            color: #e74c3c;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 500;
            font-size: 14px;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .submit-btn {
            background: linear-gradient(135deg, #27ae60, #229954);
            color: white;
            padding: 14px 25px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(39, 174, 96, 0.3);
        }
        
        /* Announcements Grid */
        .announcements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 25px;
        }
        
        .announcement-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s;
            position: relative;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .announcement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .priority-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 6px 15px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 1;
        }
        
        .priority-urgent {
            background: #e74c3c;
            color: white;
            box-shadow: 0 3px 10px rgba(231, 76, 60, 0.3);
        }
        
        .priority-high {
            background: #f39c12;
            color: white;
            box-shadow: 0 3px 10px rgba(243, 156, 18, 0.3);
        }
        
        .priority-normal {
            background: #3498db;
            color: white;
            box-shadow: 0 3px 10px rgba(52, 152, 219, 0.3);
        }
        
        .priority-low {
            background: #95a5a6;
            color: white;
            box-shadow: 0 3px 10px rgba(149, 165, 166, 0.3);
        }
        
        .announcement-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ecf0f1;
        }
        
        .announcement-content {
            padding: 25px;
        }
        
        .type-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            background: #f0f0f0;
            border-radius: 20px;
            font-size: 12px;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        
        .announcement-title {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 600;
            padding-right: 80px;
        }
        
        .announcement-text {
            color: #7f8c8d;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            max-height: 100px;
            overflow-y: auto;
            padding-right: 10px;
        }
        
        .date-range {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #95a5a6;
            margin-bottom: 15px;
            padding: 10px 0;
            border-top: 1px dashed #ecf0f1;
            border-bottom: 1px dashed #ecf0f1;
        }
        
        .date-range i {
            color: #3498db;
        }
        
        .meta-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            color: #95a5a6;
            margin-bottom: 15px;
        }
        
        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .action-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
            color: white;
            text-decoration: none;
        }
        
        .btn-edit {
            background: #3498db;
            flex: 1;
        }
        
        .btn-edit:hover {
            background: #2980b9;
        }
        
        .btn-delete {
            background: #e74c3c;
            width: 40px;
            justify-content: center;
        }
        
        .btn-delete:hover {
            background: #c0392b;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            grid-column: 1 / -1;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #bdc3c7;
            margin-bottom: 20px;
        }
        
        .empty-state h3 {
            color: #7f8c8d;
            margin-bottom: 10px;
        }
        
        .empty-state p {
            color: #95a5a6;
        }
        
        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
            }
            
            .sidebar-header h3,
            .sidebar-header p,
            .menu-item span {
                display: none;
            }
            
            .menu-item {
                justify-content: center;
                padding: 15px;
            }
            
            .main-content {
                margin-left: 80px;
            }
            
            .announcements-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-industry"></i>
                <h3>Production Unit</h3>
                <p>Admin Panel</p>
            </div>
            <div class="sidebar-menu">
                <a href="dashboard.php" class="menu-item"><i class="fas fa-home"></i><span>Dashboard</span></a>
                <a href="products.php" class="menu-item"><i class="fas fa-box"></i><span>Products</span></a>
                <a href="announcements.php" class="menu-item active"><i class="fas fa-bullhorn"></i><span>Announcements</span></a>
                <a href="offers.php" class="menu-item"><i class="fas fa-tag"></i><span>Offers</span></a>
                <a href="jobs.php" class="menu-item"><i class="fas fa-briefcase"></i><span>Jobs</span></a>
                <a href="applications.php" class="menu-item"><i class="fas fa-users"></i><span>Applications</span></a>
                <a href="inquiries.php" class="menu-item"><i class="fas fa-question-circle"></i><span>Inquiries</span></a>
                <a href="gallery.php" class="menu-item"><i class="fas fa-images"></i><span>Gallery</span></a>
                <a href="settings.php" class="menu-item"><i class="fas fa-cog"></i><span>Settings</span></a>
                <a href="logout.php" class="menu-item"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="top-bar">
                <div class="page-title">
                    <h2><i class="fas fa-bullhorn"></i> Announcements</h2>
                    <p>Manage school announcements and notifications</p>
                </div>
                <button class="add-btn" onclick="showAddModal()">
                    <i class="fas fa-plus"></i> New Announcement
                </button>
            </div>
            
            <?php if ($success_msg): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <?= $success_msg ?>
                </div>
            <?php endif; ?>
            
            <div class="announcements-grid">
                <?php if (empty($announcements)): ?>
                    <div class="empty-state">
                        <i class="fas fa-bullhorn"></i>
                        <h3>No Announcements Yet</h3>
                        <p>Click "New Announcement" to create your first announcement</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($announcements as $announcement): ?>
                        <div class="announcement-card">
                            <span class="priority-badge priority-<?= $announcement['priority'] ?>">
                                <i class="fas fa-flag"></i> <?= ucfirst($announcement['priority']) ?>
                            </span>
                            
                            <?php if ($announcement['image_path']): ?>
                                <img src="../<?= htmlspecialchars($announcement['image_path']) ?>" 
                                     alt="<?= htmlspecialchars($announcement['title']) ?>"
                                     class="announcement-image">
                            <?php endif; ?>
                            
                            <div class="announcement-content">
                                <span class="type-badge">
                                    <i class="fas fa-<?= 
                                        $announcement['type'] == 'offer' ? 'tag' : 
                                        ($announcement['type'] == 'event' ? 'calendar' : 
                                        ($announcement['type'] == 'holiday' ? 'umbrella-beach' : 'info-circle')) 
                                    ?>"></i>
                                    <?= ucfirst($announcement['type']) ?>
                                </span>
                                
                                <h3 class="announcement-title"><?= htmlspecialchars($announcement['title']) ?></h3>
                                <div class="announcement-text"><?= nl2br(htmlspecialchars($announcement['content'])) ?></div>
                                
                                <?php if ($announcement['start_date'] || $announcement['end_date']): ?>
                                    <div class="date-range">
                                        <i class="far fa-calendar-alt"></i>
                                        <?php if ($announcement['start_date']): ?>
                                            From: <?= date('M d, Y', strtotime($announcement['start_date'])) ?>
                                        <?php endif; ?>
                                        <?php if ($announcement['end_date']): ?>
                                            To: <?= date('M d, Y', strtotime($announcement['end_date'])) ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="meta-info">
                                    <span>
                                        <i class="fas fa-user"></i> 
                                        <?= htmlspecialchars($announcement['created_by_name'] ?? 'Admin') ?>
                                    </span>
                                    <span>
                                        <i class="far fa-clock"></i> 
                                        <?= date('M d, Y', strtotime($announcement['created_at'])) ?>
                                    </span>
                                </div>
                                
                                <div class="card-actions">
                                    <button class="action-btn btn-edit" onclick="editAnnouncement(<?= htmlspecialchars(json_encode($announcement)) ?>)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Delete this announcement?')">
                                        <input type="hidden" name="id" value="<?= $announcement['id'] ?>">
                                        <button type="submit" name="delete" class="action-btn btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Add/Edit Modal -->
    <div id="announcementModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle"><i class="fas fa-plus-circle"></i> New Announcement</h3>
                <button class="close-btn" onclick="hideModal()">&times;</button>
            </div>
            
            <form method="POST" enctype="multipart/form-data" id="announcementForm">
                <input type="hidden" name="id" id="announcementId">
                
                <div class="form-group">
                    <label>Title *</label>
                    <input type="text" name="title" id="announcementTitle" required placeholder="Enter announcement title">
                </div>
                
                <div class="form-group">
                    <label>Content *</label>
                    <textarea name="content" id="announcementContent" rows="5" required placeholder="Write your announcement..."></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" id="announcementType">
                            <option value="general">General</option>
                            <option value="offer">Offer</option>
                            <option value="event">Event</option>
                            <option value="holiday">Holiday</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Priority</label>
                        <select name="priority" id="announcementPriority">
                            <option value="low">Low</option>
                            <option value="normal">Normal</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Start Date (Optional)</label>
                        <input type="date" name="start_date" id="announcementStartDate">
                    </div>
                    
                    <div class="form-group">
                        <label>End Date (Optional)</label>
                        <input type="date" name="end_date" id="announcementEndDate">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Image (Optional)</label>
                    <input type="file" name="image" accept="image/*" id="announcementImage">
                    <small style="color: #7f8c8d;">Max 2MB. Leave empty to keep current image.</small>
                </div>
                
                <button type="submit" name="add" class="submit-btn" id="submitBtn">
                    <i class="fas fa-save"></i> Create Announcement
                </button>
            </form>
        </div>
    </div>
    
    <script>
        function showAddModal() {
            document.getElementById('modalTitle').innerHTML = '<i class="fas fa-plus-circle"></i> New Announcement';
            document.getElementById('announcementForm').reset();
            document.getElementById('announcementId').value = '';
            document.getElementById('submitBtn').innerHTML = '<i class="fas fa-save"></i> Create Announcement';
            document.getElementById('announcementModal').style.display = 'block';
        }
        
        function editAnnouncement(announcement) {
            document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit"></i> Edit Announcement';
            document.getElementById('announcementId').value = announcement.id;
            document.getElementById('announcementTitle').value = announcement.title;
            document.getElementById('announcementContent').value = announcement.content;
            document.getElementById('announcementType').value = announcement.type;
            document.getElementById('announcementPriority').value = announcement.priority;
            document.getElementById('announcementStartDate').value = announcement.start_date || '';
            document.getElementById('announcementEndDate').value = announcement.end_date || '';
            document.getElementById('submitBtn').innerHTML = '<i class="fas fa-save"></i> Update Announcement';
            
            // Change button name for update
            const form = document.getElementById('announcementForm');
            const oldAdd = form.querySelector('input[name="add"], button[name="add"]');
            if (oldAdd) {
                oldAdd.name = 'edit';
            }
            
            document.getElementById('announcementModal').style.display = 'block';
        }
        
        function hideModal() {
            document.getElementById('announcementModal').style.display = 'none';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('announcementModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>