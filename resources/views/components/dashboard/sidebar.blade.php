<!-- Tombol untuk membuka sidebar -->
<button class="btn btn-primary m-3" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- Sidebar -->
<div class="offcanvas offcanvas-start" id="sidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Inventory</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-group">
            <li class="list-group-item"><a href="/dashboard">Home</a></li>
            <li class="list-group-item">
                <div class="dropdown">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Items Management
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/items">Items</a></li>
                        <li><a class="dropdown-item" href="/categories">Categories</a></li>
                    </ul>
                </div>
            </li>
            <li class="list-group-item"><a href="/transactions">Transaction</a></li>
        </ul>
    </div>
</div>