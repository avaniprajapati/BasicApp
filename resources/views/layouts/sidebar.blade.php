<div class="sidebar" data-color="orange">
    <div class="logo">
        <a href="{{ url('/home') }}" class="simple-text logo-normal">
            Shreeji Sanjivani
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav main-navigation-menu">
            <li class="{{ Request::path() == 'home' ? 'active' : '' }}">
                <a href="{{ url('/home') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li>
                <a href="javascript:void(0)">
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p>Categories</p>
                </a>
                <ul class="sub-menu" style="{{ Request::path() == 'admin/categories' || Request::path() == 'admin/categories/create' ? 'display: block;' : '' }}">
					<li class="{{ Request::path() == 'admin/categories' ? 'active' : '' }}">
                        <a href="/admin/categories"> Manage Categories </a>
					</li>
					<li class="{{ Request::path() == 'admin/categories/create' ? 'active' : '' }}">
						<a href="{{ route('categories.create') }}"> Add Category </a>
					</li>
				</ul>
            </li>

            <li>
                <a href="javascript:void(0)">
                    <i class="now-ui-icons shopping_box"></i>
                    <p>Products</p>
                </a>
                <ul class="sub-menu" style="{{ Request::path() == 'admin/products' || Request::path() == 'admin/products/create' ? 'display: block;' : '' }}">
					<li class="{{ Request::path() == 'admin/products' ? 'active' : '' }}">
						<a href="/admin/products"> Manage Products </a>
					</li>
					<li class="{{ Request::path() == 'admin/products/create' ? 'active' : '' }}">
						<a href="{{ route('products.create') }}"> Add Product </a>
					</li>
				</ul>
            </li>
        </ul>
    </div>
</div>