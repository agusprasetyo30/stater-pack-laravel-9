@extends('layouts.app')

@section('title', 'User List')

@section('content')
	<section class="section">
		<div class="section-header">
			<h1>User List</h1>
		</div>

		<div class="section-body">
			<h2 class="section-title">User</h2>
            <p class="section-lead">Manage Your User Here</p>

			<div class="row mt-4">
				<div class="col-12">
					<div class="card">
					<div class="card-header">
						<h4>All Posts</h4>
					</div>
					<div class="card-body">
						<div class="float-right">
							<form method="GET">
								<div class="input-group">
								<input name="search" type="text" class="form-control" placeholder="Search" value="{{ Request::get('search') }}">
								<div class="input-group-append">
									<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
								</div>
								</div>
							</form>
						</div>

						<div class="clearfix mb-3"></div>

						<div class="table-responsive">
						<table class="table table-striped">
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Status</th>
							</tr>
							@forelse ($users as $index => $user)
							<tr>	
								<td>
									{{ $index + $users->firstItem() }}
								</td>
								<td>{{ $user->name }}
									<div class="table-links">
									<a href="#">View</a>
									<div class="bullet"></div>
									<a href="#">Edit</a>
									<div class="bullet"></div>
									<a href="#" class="text-danger">Trash</a>
									</div>
								</td>
								<td>
									{{ $user->email }}
								</td>
								<td>
									{{ $user->phone }}
								</td>
								<td>
									@if ($user->email_verified_at != null)
										<div class="badge badge-success">Active</div>
									@else
										<div class="badge badge-warning">Pending</div>
									@endif
								</td>
							</tr>
							@empty
								<tr>
									<td colspan="5" align="center">Data kosong</td>
								</tr>
							@endforelse
						</table>
						</div>
						<div class="float-right">
						<nav>
							<ul class="pagination">
								{{-- {{ $users->withQueryString()->links() }} --}}
								{{-- Untuk ->withQueryString() di taruh ke controller --}}
								{{ $users->links() }}
							</ul>
						</nav>
						</div>
					</div>
					</div>
				</div>
				</div>
		</div>
	</section>
@endsection

@section('sidebar')
	@parent

	<li class="menu-header">Starter</li>
	<li class="nav-item dropdown">
		<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
		<ul class="dropdown-menu">
			<li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
			<li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
			<li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
		</ul>
	</li>
@endsection