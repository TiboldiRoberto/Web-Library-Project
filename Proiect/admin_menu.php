<style>
    .navbar-container {
        width: 900px;
        margin: 0 auto;
    }

    .navbar {
        overflow: hidden;
        background-color: #333;
    }

    .navbar a {
        float: left;
        font-size: 20px;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .dropdown {
        float: left;
        overflow: hidden;
    }

    .dropdown .dropbtn {
        font-size: 20px;
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
    }

    .navbar a:hover,
    .dropdown:hover .dropbtn {
        background-color: dodgerblue;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    #admin-panel{
        font-family: sans-serif;
        font-size: 40px;
        color: white;
        text-align: right;
        
    }
</style>

<div class="navbar">
    <div class="navbar-container">
        <a href="admin_panel.php">Tables</a>
        <a href="form_orders.php">Orders</a>
        <div class="dropdown">
            <button class="dropbtn">Operation
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="form_insert.php">Insert</a>
                <a href="form_delete.php">Delete</a>
                <a href="form_update.php">Update</a>
            </div>
        </div>
        <a href="logout_admin.php">Logout <i class="fa">&#xf08b;</i></a>
        <p id="admin-panel">Admin panel</p>
    </div>
</div>