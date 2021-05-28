

<div class="viewemployee_all">
                <div class="profile-cover">
                    <div class="row">
                        <div class="col-md-3 profile-image">
                            <div class="profile-image-container">
                                <img src="../../img/product/<?php echo $viewproduct['image'] ?>" width="150px" height="150px" alt="">
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                    <div class="row">
                        <div class="col-md-3 user-profile">
                            <p class="text-center"><b>Product Name : &nbsp;</b><?php echo $viewproduct['item_name'];?></p>
                           
                            <hr>
                            <ul class="list-unstyled text-center">
                                <li><p><b>Model number :</b>&nbsp;<?php echo $viewproduct['model_no']; ?></p></li>
								<hr>
                               
                                <li><p><b>Price :</b>&nbsp;<?php echo $viewproduct['price']; ?></p></li>
                            </ul>
                            
                        </div>
                       
               <div class="col-md-8">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Description</h4>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>short Name</th>
                                                <th>Brand</th>
                                                <th>Unit</th>
                                                <th>Warehouse Name</th>
                                                <th>Number of Product</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row"><?php echo $viewproduct['short_name']; ?></td>
                                                <td scope="row"><?php echo $this->Amc->get_Brand_name($viewproduct['brand_id']); ?></td>
                                                <td scope="row"><?php echo $this->Amc->get_Unit_name($viewproduct['unit_id']); ?></td>
                                                <td scope="row"><?php echo $this->Amc->get_Warehouse_name($viewproduct['warehouse_id']); ?></td>
                                                <td scope="row"><?php echo $viewproduct['product_qty']; ?></td>
                                                
                                                
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
            
		</div>
		<div class="row">
		<div class="col-md-3">
                            
       </div>
		<div class="col-md-8">
		    <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title">Specification</div>
                                </div>
                                <div class="panel-body">
                                    <p><?php echo $viewproduct['specification'];?></p>
                                </div>
                            </div>       
       </div>
       </div>
	   
      
	   <div class="row">
                        <div class="col-md-3 user-profile">
                         </div>
                       
               <div class="col-md-8">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Stock Detail</h4>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Opening Stock</th>
                                                <th>Minimum Stock</th>
                                                <th>Maximum Stock</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row"><?php echo $viewproduct['open_stock']; ?></td>
                                                <td scope="row"><?php echo $viewproduct['min_stock']; ?></td>
                                                <td scope="row"><?php echo $viewproduct['max_stock']; ?></td>
                                                
                                                
                                                
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
            
		</div>
		
		</div>