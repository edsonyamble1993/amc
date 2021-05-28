<style>
footer {
  position: absolute;
  right: 0;
  bottom: -35px;
  left: 0;
  padding: 1rem;
  background-color: #F1F4F9;
  text-align: center;
}
</style>
<?php
$title = (isset($setting_data))?$setting_data['title_name']:'';
$icon = (isset($setting_data))?$setting_data['icon']:'';
$address = (isset($setting_data))?$setting_data['address']:'';
$year = (isset($setting_data))?$setting_data['year']:'';
$email = (isset($setting_data))?$setting_data['email']:'';
$logo = (isset($setting_data))?$setting_data['logo']:'';
$cover_profile = (isset($setting_data))?$setting_data['cover_profile']:'';
$sendmail = (isset($setting_data))?$setting_data['mail_send']:0;
$dateformate = (isset($setting_data))?$setting_data['dateformate']:0;
?>
<div class="row">			
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
                    
                <li class="active">
					<?php echo $this->Html->link($this->Html->tag('i','', array('class'=>'fa fa-plus-circle fa-lg')) .__('General Setting'),array('controller'=>'Setting','action'=>'setting'),array('escape'=>false));
					?> 
					  </li> 
				</ul>
</div>
<div class="row">			
		<div class="panel-body">
		<?php echo $this->Form->create('form1',['id'=>'FormId','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'setting']]);
		?>
		
		
		<div class="form-group">
		<div class="col-sm-2 label_right">
		 <?php echo $this->Form->label(__('Amc Name:')); ?> 
		 <span class="require-field">*</span>
		</div>
		<div class="col-sm-10">
		<?php echo $this->Form->input('',array('name'=>'title_name','value'=>$title,'class'=>'form-control validate[required]','placeholder'=>'Enter Amc Name')); ?>
		</div>
		</div>
		
		
		<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Upload Icon:'));?> <span class="require-field">*</span>
						</div>
						
						
						<div class="col-sm-4">
								<?php echo $this->Html->image('setting/'.$icon, ['class' => 'upload_image','id'=>'profileimg','width'=>'16px','height'=>'16px']); ?>
								<br><br>
								<input type="hidden" name="old_icon" value="<?php echo $icon;?>"> 
<?php echo $this->Form->input('',array('class'=>'file','id'=>'user_image','type'=>'file','name'=>'icon_image','PlaceHolder'=>'Select Image'));?>
						</div>
						16px X 16px
			</div>
			
			<div class="form-group">
		<div class="col-sm-2 label_right">
		 <?php echo $this->Form->label(__('Amc Address:')); ?> 
		 <span class="require-field">*</span>
		</div>
		<div class="col-sm-10">
		<?php echo $this->Form->input('',array('name'=>'address','value'=>$address,'class'=>'form-control validate[required]','placeholder'=>'Enter Address')); ?>
		</div>
		</div>
		
		
			
			
			<div class="form-group">
		<div class="col-sm-2 label_right">
		 <?php echo $this->Form->label(__('Starting Year:')); ?> 
		 <span class="require-field">*</span>
		</div>
		<div class="col-sm-10">
		<?php echo $this->Form->input('',array('name'=>'year','value'=>$year,'class'=>'form-control validate[required]','placeholder'=>'Enter Starting Year')); ?>
		</div>
		</div>
		
		<div class="form-group">
		<div class="col-sm-2 label_right">
		 <?php echo $this->Form->label(__('Email:')); ?> 
		 <span class="require-field">*</span>
		</div>
		<div class="col-sm-10">
		<?php echo $this->Form->input('',array('name'=>'email','value'=>$email,'class'=>'form-control validate[required]','placeholder'=>'Email')); ?>
		</div>
		</div>
		
		<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Logo Image:'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
								<?php echo $this->Html->image('setting/'.$logo, ['class' => 'upload_image','id'=>'profileimg','width'=>'130px','height'=>'40px']); ?>
								<br><br>
								<input type="hidden" name="old_logo" value="<?php echo $logo;?>"> 
<?php //echo $this->Form->input('',array('class'=>'file','id'=>'logo_image','type'=>'file','name'=>'logo_image','PlaceHolder'=>'Select Image'));?>
<div class="cropme" style="width: 220px; height: 200px;"></div>
      <script>
        // Init Simple Cropper
        $('.cropme').simpleCropper();
		$('.ok').click(function(){
		var data = $('.cropme').find('img').attr('src');
		console.log(data);
		$('.imagedata').val(data);
		});	
		
      </script>
		<input type="hidden" class="imagedata" name="logo_image">
	    <input type="hidden" class="originaladdedimage" value="" name="originaladdedimage">
						</div>
						130px X 40px
						
			</div>
			
			
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Select Countries'));?> 
						</div>
						<div class="col-sm-4">
						<select class="form-control validate[required]" id="countries" name="countries">

						
						
						
<option value="AF">Afghanistan</option>
<option value="AX">Åland Islands</option>
<option value="AL">Albania</option>
<option value="DZ">Algeria</option>
<option value="AS">American Samoa</option>
<option value="AD">Andorra</option>
<option value="AO">Angola</option>
<option value="AI">Anguilla</option>
<option value="AQ">Antarctica</option>
<option value="AG">Antigua and Barbuda</option>
<option value="AR">Argentina</option>
<option value="AM">Armenia</option>
<option value="AW">Aruba</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="AZ">Azerbaijan</option>
<option value="BS">Bahamas</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BB">Barbados</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BZ">Belize</option>
<option value="BJ">Benin</option>
<option value="BM">Bermuda</option>
<option value="BT">Bhutan</option>
<option value="BO">Bolivia</option>
<option value="BA">Bosnia and Herzegovina</option>
<option value="BW">Botswana</option>
<option value="BV">Bouvet Island</option>
<option value="BR">Brazil</option>
<option value="IO">British Indian Ocean Territory</option>
<option value="BN">Brunei Darussalam</option>
<option value="BG">Bulgaria</option>
<option value="BF">Burkina Faso</option>
<option value="BI">Burundi</option>
<option value="KH">Cambodia</option>
<option value="CM">Cameroon</option>
<option value="CA">Canada</option>
<option value="CV">Cape Verde</option>
<option value="KY">Cayman Islands</option>
<option value="CF">Central African Republic</option>
<option value="TD">Chad</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CX">Christmas Island</option>
<option value="CC">Cocos (Keeling) Islands</option>
<option value="CO">Colombia</option>
<option value="KM">Comoros</option>
<option value="CG">Congo</option>
<option value="CD">Congo, The Democratic Republic of The</option>
<option value="CK">Cook Islands</option>
<option value="CR">Costa Rica</option>
<option value="CI">Cote D'ivoire</option>
<option value="HR">Croatia</option>
<option value="CU">Cuba</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czechia</option>
<option value="DK">Denmark</option>
<option value="DJ">Djibouti</option>
<option value="DM">Dominica</option>
<option value="DO">Dominican Republic</option>
<option value="EC">Ecuador</option>
<option value="EG">Egypt</option>
<option value="SV">El Salvador</option>
<option value="GQ">Equatorial Guinea</option>
<option value="ER">Eritrea</option>
<option value="EE">Estonia</option>
<option value="ET">Ethiopia</option>
<option value="FK">Falkland Islands (Malvinas)</option>
<option value="FO">Faroe Islands</option>
<option value="FJ">Fiji</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="GF">French Guiana</option>
<option value="PF">French Polynesia</option>
<option value="TF">French Southern Territories</option>
<option value="GA">Gabon</option>
<option value="GM">Gambia</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GH">Ghana</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GL">Greenland</option>
<option value="GD">Grenada</option>
<option value="GP">Guadeloupe</option>
<option value="GU">Guam</option>
<option value="GT">Guatemala</option>
<option value="GG">Guernsey</option>
<option value="GN">Guinea</option>
<option value="GW">Guinea-bissau</option>
<option value="GY">Guyana</option>
<option value="HT">Haiti</option>
<option value="HM">Heard Island and Mcdonald Islands</option>
<option value="VA">Holy See (Vatican City State)</option>
<option value="HN">Honduras</option>
<option value="HK">Hong Kong</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran, Islamic Republic of</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IM">Isle of Man</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="JE">Jersey</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KE">Kenya</option>
<option value="KI">Kiribati</option>
<option value="KP">Korea, Democratic People's Republic of</option>
<option value="KR">Korea, Republic of</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Lao People's Democratic Republic</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LS">Lesotho</option>
<option value="LR">Liberia</option>
<option value="LY">Libyan Arab Jamahiriya</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MO">Macao</option>
<option value="MK">Macedonia, The Former Yugoslav Republic of</option>
<option value="MG">Madagascar</option>
<option value="MW">Malawi</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
<option value="ML">Mali</option>
<option value="MT">Malta</option>
<option value="MH">Marshall Islands</option>
<option value="MQ">Martinique</option>
<option value="MR">Mauritania</option>
<option value="MU">Mauritius</option>
<option value="YT">Mayotte</option>
<option value="MX">Mexico</option>
<option value="FM">Micronesia, Federated States of</option>
<option value="MD">Moldova, Republic of</option>
<option value="MC">Monaco</option>
<option value="MN">Mongolia</option>
<option value="ME">Montenegro</option>
<option value="MS">Montserrat</option>
<option value="MA">Morocco</option>
<option value="MZ">Mozambique</option>
<option value="MM">Myanmar</option>
<option value="NA">Namibia</option>
<option value="NR">Nauru</option>
<option value="NP">Nepal</option>
<option value="NL">Netherlands</option>
<option value="AN">Netherlands Antilles</option>
<option value="NC">New Caledonia</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="NE">Niger</option>
<option value="NG">Nigeria</option>
<option value="NU">Niue</option>
<option value="NF">Norfolk Island</option>
<option value="MP">Northern Mariana Islands</option>
<option value="NO">Norway</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PW">Palau</option>
<option value="PS">Palestinian Territory, Occupied</option>
<option value="PA">Panama</option>
<option value="PG">Papua New Guinea</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PN">Pitcairn</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RE">Reunion</option>
<option value="RO">Romania</option>
<option value="RU">Russian Federation</option>
<option value="RW">Rwanda</option>
<option value="SH">Saint Helena</option>
<option value="KN">Saint Kitts and Nevis</option>
<option value="LC">Saint Lucia</option>
<option value="PM">Saint Pierre and Miquelon</option>
<option value="VC">Saint Vincent and The Grenadines</option>
<option value="WS">Samoa</option>
<option value="SM">San Marino</option>
<option value="ST">Sao Tome and Principe</option>
<option value="SA">Saudi Arabia</option>
<option value="SN">Senegal</option>
<option value="RS">Serbia</option>
<option value="SC">Seychelles</option>
<option value="SL">Sierra Leone</option>
<option value="SG">Singapore</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="SB">Solomon Islands</option>
<option value="SO">Somalia</option>
<option value="ZA">South Africa</option>
<option value="GS">South Georgia and The South Sandwich Islands</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SD">Sudan</option>
<option value="SR">Suriname</option>
<option value="SJ">Svalbard and Jan Mayen</option>
<option value="SZ">Swaziland</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="SY">Syrian Arab Republic</option>
<option value="TW">Taiwan, Province of China</option>
<option value="TJ">Tajikistan</option>
<option value="TZ">Tanzania, United Republic of</option>
<option value="TH">Thailand</option>
<option value="TL">Timor-leste</option>
<option value="TG">Togo</option>
<option value="TK">Tokelau</option>
<option value="TO">Tonga</option>
<option value="TT">Trinidad and Tobago</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="TM">Turkmenistan</option>
<option value="TC">Turks and Caicos Islands</option>
<option value="TV">Tuvalu</option>
<option value="UG">Uganda</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="GB">United Kingdom</option>
<option value="US">United States</option>
<option value="UM">United States Minor Outlying Islands</option>
<option value="UY">Uruguay</option>
<option value="UZ">Uzbekistan</option>
<option value="VU">Vanuatu</option>
<option value="VE">Venezuela</option>
<option value="VN">Viet Nam</option>
<option value="VG">Virgin Islands, British</option>
<option value="VI">Virgin Islands, U.S.</option>
<option value="WF">Wallis and Futuna</option>
<option value="EH">Western Sahara</option>
<option value="YE">Yemen</option>
<option value="ZM">Zambia</option>
<option value="ZW">Zimbabwe</option>
</select>
								</div>
						
			</div>
		<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Send Email Notification'));?> 
						</div>
						<div class="col-sm-4">
						<input type="checkbox" value="1" name="send_email_value" <?php if($sendmail == 1){ echo 'checked'; } ?>>
								</div>
						
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Date Format'));?> 
						</div>
						<div class="col-sm-4">
						<select class="form-control validate[required]" id="dateformate" name="dateformate">
						<option value="d-m-y" <?php if($dateformate == 'd-m-y'){ echo 'Selected'; }?>>DD-MM-YYYY</option>
						<option value="m-d-y" <?php if($dateformate == 'm-d-y'){ echo 'Selected'; }?>>MM-DD-YYYY</option>
						<option value="y-m-d" <?php if($dateformate == 'y-m-d'){ echo 'Selected'; }?>>YYYY-MM-DD</option>
						</select>
								</div>
						
			</div>
		<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Save Changes'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success')); ?>
				</div>
				
				<?php echo $this->Form->end(); ?>
		</div>
</div>