<?php 
	if(isset($_POST['savesettings'])){		
		SaveSettings("DataPerPage",$_POST['DataPerPage']);
		SaveSettings("DefaultSearch",$_POST['DefaultSearch']);
		//SaveSettings("GetContentFirst",$_POST['GetContentFirst']);
		//SaveSettings("GetPhoto",$_POST['GetPhoto']);
		SaveSettings("URLSource",$_POST['URLSource']);
		SaveSettings("URLSourceLimit",$_POST['URLSourceLimit']);

		echo "<script>alert('Setting has been Saved');window.location='?m=Setting'</script>";
	}
	elseif(isset($_POST['saveuser'])){
		SaveUser($_POST['UserGroup'],$_POST['UserName'],$_POST['UserRealName'],$_POST['UserPassword'],$_POST['UserRePassword']);
		
	}
	elseif(isset($_POST['updateuser'])){
		UpdateUser($_POST['UserId'],$_POST['UserGroup'],$_POST['UserName'],$_POST['UserRealName'],$_POST['UserPassword'],$_POST['UserRePassword']);
		
	}
	elseif(isset($_GET['op'])){
		$op = $_GET['op'];
		if($op=="deluser"){
			$value = $_GET['value'];
			$del = mysql_query("DELETE  FROM `user` WHERE `user_id`='$value'")or die(mysql_error());
			if($del){
				echo "<script>alert('User has been deleted');window.location='?m=Setting'</script>";
			}
		}
		elseif($op=="get_content_from_newsd"){
			$a = exec('clipdig get_content_from_newsd');
			//send_notif('get_content_from_newsd starting');
			send_notif($a);
		}
	}
?>
<div class="col-lg-6">
<div class="well-sm well-me">
	<form method="post" action="?m=Setting">
	<table class="table table-hover">
		<tr>
			<td colspan="2"><h5><i class="fa fa-gear"></i> Setting</h5></td>
		</tr>
		<tr>
			<td width="30%">Name:</td>
			<td><?php echo Settings('Name'); ?></td>
		</tr>
		<tr>
			<td width="30%">Version:</td>
			<td><?php echo Settings('Version'); ?></td>
		</tr>
		<tr>
			<td width="30%">Description:</td>
			<td><?php echo Settings('Description'); ?></td>
		</tr>
		<tr>
			<td width="30%">Data Per Page:</td>
			<td><input type="number" name="DataPerPage" value="<?php echo Settings('DataPerPage'); ?>" class="form-control"></td>
		</tr>
		<tr>
			<td>Time Out:</td>
			<td>
				<div class="input-group">
					<input type="number" name="TimeOut" value="<?php echo Settings('TimeOut');?>" class="form-control">
					<div class="input-group-addon">
						Seconds
					</div>
				</div>
				
			</td>
		</tr>
		<!-- <tr>
			<td>Get Content First:</td>
			<td class="checkbox"><input type="checkbox" name="GetContentFirst"  value="1" class="checkbox" <?php if(Settings('GetContentFirst')=="1"){echo "checked ";}?> >Enable</td>
		</tr>
		<tr>
			<td>Get Photo:</td>
			<td class="checkbox"><input type="checkbox" name="GetPhoto"  value="1" class="checkbox" <?php if(Settings('GetPhoto')=="1"){echo "checked ";}?> >Enable</td>
		</tr> -->
		<tr>
			<td>URL Source:</td>
			<td><input type="text" name="URLSource" value="<?php echo Settings('URLSource');?>" class="form-control"></td>
		</tr>
		<tr>
			<td>URL Source Limit:</td>
			<td>
				<input type="number" name="URLSourceLimit" value="<?php echo Settings('URLSourceLimit');?>" class="form-control">
				<small>-1: limit 2000</small>
			</td>
		</tr>
		<tr>
			<td>Default Search:</td>
			<td><input type="text" name="DefaultSearch" value="<?php echo Settings('DefaultSearch');?>" class="form-control"></td>
		</tr>
		
	</table>
	<div><button type="submit" name="savesettings" class=" btn btn-primary"><i class="fa fa-save"></i> Save</button></div>
	</form>
</div>
</div>
<?php
	//}
?>

<div class="col-lg-6">
	<div class="well-sm well-me">
<?php
if(empty($_GET['op'])){
?>
		<table class="table" id="dataUsers">
			<tr>
				<td><h5><i class="fa fa-user"></i>  Users</h5></td>
				<td valign="middle" colspan="2">
					<div class="pull-right">
						<a class="btn btn-primary " href="?m=Setting&op=AddUser"><i class="fa fa-plus"></i> Add</a>
					</div>
				</td>
			</tr>
			<tr>
				<th></th>
				<th align="left">User Name</th>
				<th align="left">User Real Name</th>
				
			</tr>
			<?php 
				$q = mysql_query("select * from `user`") or die(mysql_error());
				while($user = mysql_fetch_array($q)){
					echo '<tr>
						<td width="100px">
							<a role="menuitem" tabindex="-1" href="?m='.$_GET['m'].'&op=EditUser&id='.$user['user_id'].'"><i class="fa fa-edit"></i></a>
							<a role="menuitem" tabindex="-1" class="delete text-danger" href="?m=Setting&op=deluser&value='.$user['user_id'].'"><i class="fa fa-trash"></i></a>
						</td>
						<td>'.$user['user_name'].'</td>
						<td>'.$user['user_real_name'].'</td>
					</tr>';
				}
			?>
			
		</table>
<?php
}
else{
	if(isset($_GET['op'])){
		if($_GET['op']=="EditUser"){
			$qa = mysql_query("SELECT * FROM `user` WHERE `user_id`='".$_GET['id']."'") or die (mysql_error());
			$user = mysql_fetch_array($qa);
			$edit = 1;
		}
		else{
			$edit=0;
		}
	}
?>	
	<form action="?m=Setting" method="post">
		<table class="table">
			<tr>
				<td>User Name: <input class="form-control" name="UserName" value="<?php if($edit==1){echo $user['user_name'];} ?>"></td>
				<td>User Real Name: <input class="form-control" name="UserRealName" value="<?php if($edit==1){echo $user['user_real_name'];} ?>"></td>
				<td>User Group:
					<select class="form-control" name="UserGroup">
						<option value="1" <?php if($edit==1){if($user['group_id']==1)echo "selected";} ?>>Administator</option>
						<option value="2" <?php if($edit==1){if($user['group_id']==2)echo "selected";} ?>>User</option>
					</select>
				</td>
				<td>Password: <input class="form-control" name="UserPassword" type="password"></td>
				<td>Retype Password: <input class="form-control" name="UserRePassword" type="password"></td>
			</tr>
			<tr>
				<?php 
					if($_GET['op']=="AddUser"){
						echo '<td colspan="4"><button class="btn-primary btn" type="submit" name="saveuser"><i class="fa fa-save" ></i> Save</td>';
					}
					elseif($_GET['op']=="EditUser"){
						echo '<td colspan="4">
									<button class="btn-primary btn" type="submit" name="updateuser"><i class="fa fa-arrow-up" ></i> Update
									<input type="hidden" name="UserId" value="'.$_GET['id'].'">
								</td>';
					}
				?>
			</tr>
		</table>
		</form>
<?php	
}
?>
</div>
</div>

<div class="col-lg-6">
	<div class="well-sm well-me">
	<a href="?m=Setting&op=get_content_from_newsd" class="btn btn-primary">get content from newsd</a>
<!--
	<a href="?m=dashboard&op=stop" class="btn btn-primary">Stop</a>	
-->
		
	</div>
</div>
