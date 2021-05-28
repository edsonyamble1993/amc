<?php
    use Cake\Controller\Component;
    use Cake\ORM\TableRegistry; 
    $user_role=$this->request->session()->read('user_role');
    $user_id=$this->request->session()->read('user_id');
    $user_image=$this->request->session()->read('user_image');
  
  ?>


                    <ul>
                    
<li class=""><i class="fa fa-tachometer image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Dashboard'),['controller' => 'Dashboard', 'action' => 'employeedashboard']);?></a>
   </li>
                    <?php  if($this->Amc->findstatus($user_role,'supplier')==1 || $this->Amc->findstatus($user_role,'product')==1 || $this->Amc->findstatus($user_role,'purchase')==1 || $this->Amc->findstatus($user_role,'stoke')==1) {?>	
					<li class="has-sub"><i class="fa fa-user image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Master'),['controller' => 'Purchase', 'action' => 'viewpurchase']);?>
					
				
						<ul>
						<?php if($this->Amc->findstatus($user_role,'supplier')==1){   ?>
        					<li><i class="fa fa-product-hunt image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Supplier'),['controller' => 'supplier', 'action' => 'suppliers']);?>
           				 	</li>
        					<?php } ?>
							<?php if($this->Amc->findstatus($user_role,'product')==1){   ?>
        					<li><i class="fa fa-product-hunt image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Product'),['controller' => 'Product', 'action' => 'productlist']);?>
           				 	</li>
        					<?php } ?>
							<?php if($this->Amc->findstatus($user_role,'purchase')==1){   ?>
        					<li><i class="fa fa-shopping-cart image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Purchase'),['controller' => 'Purchase', 'action' => 'viewpurchase']);?>
           				 	</li>
        					<?php } ?>
        			
                
        					
							
							<?php if($this->Amc->findstatus($user_role,'stoke')==1){   ?>	
							<li><i class="fa fa-mars-stroke image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Stock'),['controller' => 'Stoke', 'action' => 'Stokes']);?>
           				 	</li>
							<?php }  ?>
							
							<?php if($this->request->session()->read('user_role') == 'admin'){   ?>
      <li><i class="fa fa-tasks image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Taxes'),['controller' => 'tax', 'action' => 'viewtax']);?></a>
     
   </li>
   <?php } ?>
	
						</ul>
							
					</li>
					
					<?php } ?>
					
					
	<?php if($this->Amc->findstatus($user_role,'client')==1){   ?>				
   	<li class='has-sub'><i class="fa fa-users image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Client'),['controller' => 'Client', 'action' => 'clientlist']);?></a>
      </li>

<?php } ?>
<?php if($this->Amc->findstatus($user_role,'employee')==1){   ?>
    <li class='has-sub'><i class="fa fa-user-plus image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Employee'),['controller' => 'Employee', 'action' => 'employeelist']);?></a>
     
   </li>
   <?php } ?>
   
   <?php if($this->Amc->findstatus($user_role,'quotation')==1){   ?>
     	<li class='has-sub'><i class="fa fa-credit-card-alt image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Quotation'),['controller' => 'quotation', 'action' => 'quotationlist']);?></a>
      
   </li>
     <?php } ?>
    <?php if($this->Amc->findstatus($user_role,'sales')==1){   ?>
   	<li class='has-sub'><i class="fa fa-tty image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Sales'),['controller' => 'Sales', 'action' => 'viewsales']);?></a>
      
   </li>
    <?php } ?>
      
   
   <?php if($this->Amc->findstatus($user_role,'amc')==1){   ?>
   <li class='has-sub'><i class="fa fa-bookmark image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('AMC'),['controller' => 'amc', 'action' => 'viewamc']);?></a>
     
   </li>
      <?php } ?> 
	  
	  
	  
   <?php if($this->Amc->findstatus($user_role,'complaint')==1){   ?>
   <li class=''><i class="fa fa-indent image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Complaint'),['controller' => 'complaint', 'action' => 'viewcomplaint']);?></a>
      
   </li>
   
   <?php } ?> 
   
      <?php if($this->Amc->findstatus($user_role,'service')==1){   ?>
   <li class='has-sub'><i class="fa fa-slack image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('service'),['controller' => 'service', 'action' => 'viewservice']);?></a>
     
   </li>
      <?php } ?> 
   
   <?php if($this->Amc->findstatus($user_role,'task')==1){   ?>
      <li class=''><i class="fa fa-tasks image_icon" aria-hidden="true">
      </i><?php echo $this->Html->link(__('Task'),['controller' => 'task', 'action' => 'viewtask']);?>
    </a>
     
   </li>
   <?php } ?>
     <?php if($this->Amc->findstatus($user_role,'expenses')==1){   ?>
     <li class='has-sub'><i class="fa fa-expand image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Expenses'),['controller' => 'Expenses', 'action' => 'viewexpenses']);?></a>
      <ul>
         <li class=''><?php echo $this->Html->link(__('Add Expenses'),['controller' => 'Expenses', 'action' => 'addexpenses']);?></li>
        <li class=''><?php echo $this->Html->link(__('Expenses List'),['controller' => 'Expenses', 'action' => 'viewexpenses']);?></li>
      </ul>
   </li>
 <?php } ?>
 <?php if($this->Amc->findstatus($user_role,'income')==1){   ?>
    <li class='has-sub'><i class="fa fa-money image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Income'),['controller' => 'Income', 'action' => 'viewincome']);?></a>
      <ul>
         <li class=''><?php echo $this->Html->link(__('Add Income'),['controller' => 'Income', 'action' => 'addincome']);?></li>
        <li class=''><?php echo $this->Html->link(__('Income List'),['controller' => 'Income', 'action' => 'viewincome']);?></li>
      </ul>
   </li>
   <?php } ?>
   
	
                    </ul>