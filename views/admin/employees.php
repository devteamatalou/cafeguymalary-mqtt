<?php
	session_start();

	if(empty($_SESSION['admin']))
		header('Location: login.php');

		include '../../vendor/autoload.php';

		use src\dao\EmpDao;
		$empdao = new EmpDao();
		$select_all_emps = $empdao->selectAllEmps();

	include '../includes/header.php';
	include '../includes/sidebar.php';
?>

	<main id="main" class="main">
		<div class="pagetitle">
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="../admin/">Home</a></li>
					<li class="breadcrumb-item active">Employees</li>
				</ol>
			</nav>
		</div><!-- End Page Title -->
		<section class="section">
			<div class="row mb-3">
				<div class="col-md-12">
					<a href="#form" class="btn btn-primary pull-right" data-toggle="modal"><i class="bi bi-plus"></i> <span>Add Employee</span></a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="">
						<div class="">
							<table id="example" class="table table-striped table-bordered dt-responsive nowrap custom-table" style="width:100%">
								<thead>
									<tr>
										<th>Firstname</th>
										<th>Lastname</th>
										<th>Sex</th>
										<th>Barcode</th>
										<th>Dated Created</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									 while($allemps = $select_all_emps->fetch(PDO::FETCH_OBJ)):
									?>
										<tr>
											<td><?= $allemps->prenom; ?></td>
											<td><?= $allemps->nom; ?></td>
											<td><?= $allemps->sexe; ?></td>
											<td><?= $allemps->barcode; ?></td>
											<td><?= $allemps->created_at; ?></td>
											<td>
												<a href="#editCategoryModal" class="btn btn-success" data-toggle="modal"><i class="bi bi-pencil-square" data-toggle="tooltip" title="Edit"></i></a>
												<a href="#deleteCategoryModal" class="btn btn-danger" data-toggle="modal"><i class="bi bi-trash" data-toggle="tooltip" title="Delete"></i></a>
											</td>
										</tr>
									<?php
									 endwhile;
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- Add Products Modal HTML -->
			<div id="form" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form id="addemp" action="" method="post">
							<div class="modal-header">
								<h4 class="modal-title">Add Employee</h4>
								<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Firstname</label>
									<input name="fname" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Lastname</label>
									<input name="lname" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Barcode</label>
									<input name="barcode" type="text" class="form-control" required/>
								</div>
								<div class="form-group">
									<label>Gender</label>
									<select name="gender" class="form-select" required>
										<option value="M">M</option>
										<option value="F">F</option>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<button type="submit" class="btn btn-success">Add</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Edit Products Modal HTML -->
			<div id="editCategoryModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form>
							<div class="modal-header">
								<h4 class="modal-title">Edit Product</h4>
								<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Name</label>
									<input type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Address</label>
									<textarea class="form-control" required></textarea>
								</div>
								<div class="form-group">
									<label>Phone</label>
									<input type="text" class="form-control" required>
								</div>
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<input type="submit" class="btn btn-info" value="Save">
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Delete Products Modal HTML -->
			<div id="deleteCategoryModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form>
							<div class="modal-header">
								<h4 class="modal-title">Delete Product</h4>
								<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
							</div>
							<div class="modal-body">
								<p>Are you sure you want to delete these products?</p>
								<p class="text-warning"><small>This action cannot be undone.</small></p>
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<input type="submit" class="btn btn-danger" value="Delete">
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>

<?php include '../includes/footer.php'; ?>