  <nav class="col-md-2 d-none d-md-block bg-light sidebar pt-3">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expands="false" href="{{route('admin.product.index')}}" >
              <span data-feather="shopping-cart"></span>
              Products
            </a>
			
			<div class="dropdown-menu dropdown-menu-right">
					<a href="{{route('admin.trash.get')}}" class="dropdown-item" type="button">Trash Products</a>
					<a href="{{route('admin.product.index')}}" class="dropdown-item" type="button">All Products</a>
			</div>
          </li>
          
		  <li class="nav-item">
		  
					<div class="btn-group">
					
		  <a href="{{route('admin.category.index')}}" class=" nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span data-feather="list"></span>
			Category
		  </a>
		  <div class="dropdown-menu dropdown-menu-right">
			<a href="#" class="dropdown-item" type="button">Trah Category</a>
			<a href="{{route('admin.category.index')}}" class="dropdown-item" type="button">Category</a>
		  </div>
		  
		    </div>
		  </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>