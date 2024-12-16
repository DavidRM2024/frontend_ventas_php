<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>



    html,
    body {
        height: 100%;
        margin: 0;
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, rgb(243, 205, 176) 0%, #fad0c4 100%);
        scrollbar-width: none;
    }

    .navbar {
        background-color: rgb(42, 41, 41) !important;
    }

    .navbar-brand {
        font-weight: bold;
        color: #fff !important;
    }

    .nav-link {
        color: #fff !important;
    }

    .nav-link:hover {
        color:rgb(222, 201, 77) !important;
    }

    #content {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
    }

    .card {
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        margin-bottom: 65px;
    }

    footer {
        background-color: rgb(27, 27, 27);
        color: #fff;
        text-align: center;
        padding: 15px;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 3;
    }

    table {
        overflow: auto;
    }
</style>