


<?php
	include("dbconnect.php");
	$semester=$_REQUEST['semester'];
	$section=$_REQUEST['section'];
	
	$subject_rs=mysqli_query($con,"select subject_id,subject_name from subject_master where semester=$semester and either_batch=0") ;
	
	$count_teachers=mysqli_query($con,"select count(*) from user_master where user_type='faculty' order by name ");
	$count_teachers1=mysqli_fetch_array($count_teachers);
	$count_teachers2=$count_teachers1[0];
	
	$flag=1;
				
	echo "<div class='table-responsive'>";
	echo"<table class='table'>";	
	//	echo"<form name='form1'>";
			$j=0;
				$teacher_rs=mysqli_query($con,"select user_id,name from user_master where user_type='faculty' order by name ");
			while($subject_rs1=mysqli_fetch_array($subject_rs))
			{
				$default_allot_res=mysqli_query($con,"select teacher_id from teacher_subject_relation where subject_id=$subject_rs1[0] and section='$section'");
				$default_allot_res1=mysqli_fetch_array($default_allot_res);
				$default_allot_id=$default_allot_res1[0];
				
				$default_allot_resss=mysqli_query($con,"select name from user_master where (user_id='$default_allot_id' && user_type='faculty')");
				$default_allot_resss1=mysqli_fetch_array($default_allot_resss);
				$default_allot_name=$default_allot_resss1[0];
				
				if($default_allot_id==NULL && $flag==1)
				{
					$flag=0;
										
				}
				
				else if($default_allot_id!=NULL)
				{
				
				
				echo "<tr>";
				echo "<td>"."<input type='text'  value='$subject_rs1[1]' name='subject[]' disabled class='formCSS'>"."</td>";
				echo "<td>"."<input type='hidden' value='$subject_rs1[0]' name='subject_id[]'>"."</td>";	
							
				echo "<td>"."<select name='teacher_id[]' class='formCSS'>";
					
					//echo "<option value='$default_allot_id' selected>".$default_allot_name."</option>";
					$m=0;
				
					
					$i=0;
					while($i<mysqli_num_rows($teacher_rs))
					{
					    mysqli_data_seek($teacher_rs,$i);
						$teacher_rs1=mysqli_fetch_array($teacher_rs);
						//echo "<option value='$teacher_rs1[0]' >".$teacher_rs1[1]."</option>"; 
						if($teacher_rs1[0]!=$default_allot_id)
						{
							echo "<option value='$teacher_rs1[0]' >".$teacher_rs1[1]."</option>";					
						}
						else
						{
						echo "<option value='$teacher_rs1[0]' selected='selected' >".$teacher_rs1[1]."</option>";
						}
						
						
						$i++;
					}
					
					/*
					
					while($teacher_rs1=mysqli_fetch_array($teacher_rs))
					{
						
					}
					*/
					
				echo"</select>"."</td>";
				
				echo"<td>"."<input type='button' value='Update' onClick='update_allot_fn($subject_rs1[0],$j);' class='formButton'>"."</td>";	
				$j++;
				echo "</tr>";
				}
			} 
		if($default_allot_id==NULL && $flag==0)
				{
					echo "ALLOTMENT IS STILL AWAITED";
										
				}
					
		echo "<tr><th class='text-center' >Batch:-</th><th class='text-center' colspan=5 >Batch B1</th>";
		
		while($subject_rs1=mysqli_fetch_array($subject_rs))
			{
				$default_allot_res=mysqli_query($con,"select teacher_id from teacher_subject_relation where subject_id=$subject_rs1[0] and section='$section' and batch='1' ");
				$default_allot_res1=mysqli_fetch_array($default_allot_res);
				$default_allot_id=$default_allot_res1[0];
				
				$default_allot_resss=mysqli_query($con,"select name from user_master where (user_id='$default_allot_id' && user_type='faculty')");
				$default_allot_resss1=mysqli_fetch_array($default_allot_resss);
				$default_allot_name=$default_allot_resss1[0];
				
				if($default_allot_id==NULL && $flag==1)
				{
					$flag=0;
										
				}
				
				else if($default_allot_id!=NULL)
				{
				
				
				echo "<tr>";
				echo "<td>"."<input type='text'  value='$subject_rs1[1]' name='subject[]' disabled class='formCSS'>"."</td>";
				echo "<td>"."<input type='hidden' value='$subject_rs1[0]' name='subject_id[]'>"."</td>";	
							
				echo "<td>"."<select name='teacher_id[]' class='formCSS'>";
					
					//echo "<option value='$default_allot_id' selected>".$default_allot_name."</option>";
					$m=0;
				
					
					$i=0;
					while($i<mysqli_num_rows($teacher_rs))
					{
					    mysqli_data_seek($teacher_rs,$i);
						$teacher_rs1=mysqli_fetch_array($teacher_rs);
						//echo "<option value='$teacher_rs1[0]' >".$teacher_rs1[1]."</option>"; 
						if($teacher_rs1[0]!=$default_allot_id)
						{
							echo "<option value='$teacher_rs1[0]' >".$teacher_rs1[1]."</option>";					
						}
						else
						{
						echo "<option value='$teacher_rs1[0]' selected='selected' >".$teacher_rs1[1]."</option>";
						}
						
						
						$i++;
					}
					
					/*
					
					while($teacher_rs1=mysqli_fetch_array($teacher_rs))
					{
						
					}
					*/
					
				echo"</select>"."</td>";
				
				echo"<td>"."<input type='button' value='Update' onClick='update_allot_fn($subject_rs1[0],$j);' class='formButton'>"."</td>";	
				$j++;
				echo "</tr>";
				}
			} 
		//echo"</form>";
	echo"</table>";
	echo "</div>";
	
	
?>

	