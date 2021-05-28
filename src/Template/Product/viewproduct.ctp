<div class="item-container product_detail">	
			<div class="container">	
				<div class="col-md-12">
					<div class="product col-md-4 service-image-left">
                    
						<center>
							 <img src="../../img/product/<?php echo $viewproduct['image'] ?>" width="305px" height="305px" style="border-radius:50%;">
						</center>
					</div>
					
					
					
				<div class="col-md-7">
					<div class="product-title"><b>Product Name : &nbsp;</b><?php echo $viewproduct['item_name'];?></div>
					<div class="product-desc"><b>Model number :</b>&nbsp;<?php echo $viewproduct['model_no']; ?></div>
					<div class="product-desc"><b>Price :</b>&nbsp;<?php echo $viewproduct['price']; ?></div>
					<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>
					<hr>
					<div class="product-price">$ 1234.00</div>
					<div class="product-stock">In Stock</div>
					<hr>
				<!--	<div class="btn-group cart">
						<button type="button" class="btn btn-success">
							Add to cart 
						</button>
					</div>
					<div class="btn-group wishlist">
						<button type="button" class="btn btn-danger">
							Add to wishlist 
						</button>
					</div>
-->
				</div>
			</div> 
		
			
			<div class="col-md-12 product-info">
					<ul id="myTab" class="nav nav-tabs nav_tabs">
						
						<li class="active"><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
						<li><a href="#service-two" data-toggle="tab">PRODUCT INFO</a></li>
						<li><a href="#service-three" data-toggle="tab">STOCK DETAIL</a></li>
						
					</ul>
				<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="service-one">
						 
							<section class="container product-info">
								<?php echo $viewproduct['specification'];?>
<!--
								<h3>Corsair Gaming Series GS600 Features:</h3>
								<li>It supports the latest ATX12V v2.3 standard and is backward compatible with ATX12V 2.2 and ATX12V 2.01 systems</li>
								<li>An ultra-quiet 140mm double ball-bearing fan delivers great airflow at an very low noise level by varying fan speed in response to temperature</li>
								<li>80Plus certified to deliver 80% efficiency or higher at normal load conditions (20% to 100% load)</li>
								<li>0.99 Active Power Factor Correction provides clean and reliable power</li>
								<li>Universal AC input from 90~264V — no more hassle of flipping that tiny red switch to select the voltage input!</li>
								<li>Extra long fully-sleeved cables support full tower chassis</li>
								<li>A three year warranty and lifetime access to Corsair’s legendary technical support and customer service</li>
								<li>Over Current/Voltage/Power Protection, Under Voltage Protection and Short Circuit Protection provide complete component safety</li>
								<li>Dimensions: 150mm(W) x 86mm(H) x 160mm(L)</li>
								<li>MTBF: 100,000 hours</li>
								<li>Safety Approvals: UL, CUL, CE, CB, FCC Class B, TÜV, CCC, C-tick</li>
-->
							</section>
										  
						</div>
					<div class="tab-pane fade" id="service-two">
						
						<section class="container">
								
                            <div class="panel panel-white">
                                
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
                            
                       
						</section>
						
					</div>
					<div class="tab-pane fade" id="service-three">
												 <div class="panel panel-white">
                                
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
				<hr>
			</div>
		</div>
	</div>
