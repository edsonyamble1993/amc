
<div id="main-wrapper">
                    <div class="row">
						<div class="col-md-12">
							<div class="box-header">
									<section class="content-header">
									  <h1><i class="fa fa-key"></i>&nbsp;Access Right Settings&nbsp;<small>Access Right</small></h1>			  		</section>
							</div>
							<hr>
							<form action="" method="post" class="form-horizontal" id="access_right_form">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Menu Name</th>
                                                <th>Employee</th>
                                                <th>Client</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td><?php echo __("Supplier"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["supplier"])?"checked":"";?> value="1" name="supplier_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["supplier"])?"checked":"";?> value="1" name="supplier_client" readonly=""></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td><?php echo __("Product"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["product"])?"checked":"";?> value="1" name="product_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["product"])?"checked":"";?> value="1" name="product_client" readonly=""></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td><?php echo __("Purchase"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["purchase"])?"checked":"";?> value="1" name="purchase_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["purchase"])?"checked":"";?> value="1" name="purchase_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">4</th>
                                                <td><?php echo __("Stock"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["stoke"])?"checked":"";?> value="1" name="stock_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["stoke"])?"checked":"";?> value="1" name="stock_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">5</th>
                                                <td><?php echo __("Client"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["client"])?"checked":"";?> value="1" name="client_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["client"])?"checked":"";?> value="1" name="client_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">6</th>
                                                <td><?php echo __("Employee"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["employee"])?"checked":"";?> value="1" name="employee_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["employee"])?"checked":"";?> value="1" name="employee_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">7</th>
                                                <td><?php echo __("Quotation"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["quotation"])?"checked":"";?> value="1" name="quotation_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["quotation"])?"checked":"";?> value="1" name="quotation_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">8</th>
                                                <td><?php echo __("Sales"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["sales"])?"checked":"";?> value="1" name="sales_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["sales"])?"checked":"";?> value="1" name="sales_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">9</th>
                                                <td><?php echo __("Invoice"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["invoice"])?"checked":"";?> value="1" name="invoice_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["invoice"])?"checked":"";?> value="1" name="invoice_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">10</th>
                                                <td><?php echo __("Amc"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["amc"])?"checked":"";?> value="1" name="amc_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["amc"])?"checked":"";?> value="1" name="amc_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">11</th>
                                                <td><?php echo __("Complaint"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["complaint"])?"checked":"";?> value="1" name="complaint_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["complaint"])?"checked":"";?> value="1" name="complaint_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">12</th>
                                                <td><?php echo __("Service"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["service"])?"checked":"";?> value="1" name="service_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["service"])?"checked":"";?> value="1" name="service_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">13</th>
                                                <td><?php echo __("Task"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["task"])?"checked":"";?> value="1" name="task_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["task"])?"checked":"";?> value="1" name="task_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">14</th>
                                                <td><?php echo __("Expenses"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["expenses"])?"checked":"";?> value="1" name="expenses_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["expenses"])?"checked":"";?> value="1" name="expenses_client" readonly=""></td>
                                            </tr>
											<tr>
                                                <th scope="row">15</th>
                                                <td><?php echo __("Income"); ?></td>
                                                <td><input type="checkbox" <?php echo ($employee["income"])?"checked":"";?> value="1" name="income_employee" readonly=""></td>
                                                <td><input type="checkbox" <?php echo ($client["income"])?"checked":"";?> value="1" name="income_client" readonly=""></td>
                                            </tr>
											
                                        </tbody>
                                    </table>
									<hr/>
									<div class="col-sm-offset-2 col-sm-8 row_bottom">
        	
        	<input type="submit" value="<?php echo __("Save");?>" name="save_access_right" class="btn btn-flat btn-success">
        </div>
                                </div>
								
                            </div>
							
                            </form>
                        </div>
					</div>
</div>