<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<table class="table table-striped">
	  		<thead>
	  			<tr>
	  				<th class="text-center">Id</th>
	  				<th class="text-center">Логин</th>
	  				<th class="text-center">E-mail</th>
	  				<th class="text-center">Имя</th>
	  				<th class="text-center">Фамилия</th>
	  			</tr>		
	  		</thead>
	  		<tbody class="text-center">
	  			<tr>
	  				<td class="text-center">00001</td>
	  				<td class="text-center">Ivan</td>
	  				<td class="text-center">ivan@mail</td>
	  				<td class="text-center">Иван</td>
	  				<td class="text-center">Иванов</td>
	  			</tr> 
	  			<tr>
	  				<td class="text-center">00002</td>
	  				<td class="text-center">Ivan</td>
	  				<td class="text-center">ivan@mail</td>
	  				<td class="text-center">Иван</td>
	  				<td class="text-center">Иванов</td>
	  			</tr> 
	  			<tr>
	  				<td class="text-center">00003</td>
	  				<td class="text-center">Ivan</td>
	  				<td class="text-center">ivan@mail</td>
	  				<td class="text-center">Иван</td>
	  				<td class="text-center">Иванов</td>
	  			</tr>
	  			<tr>
	  				<td class="text-center"><?=$_SESSION["user_info"]["id"]?></td>
	  				<td class="text-center"><?=$_SESSION["user_info"]["login"]?></td>
	  				<td class="text-center"><?=$_SESSION["user_info"]["email"]?></td>
	  				<td class="text-center"><?=$_SESSION["user_info"]["fistName"]?></td>
	  				<td class="text-center"><?=$_SESSION["user_info"]["lastName"]?></td>
	  			</tr>  			
	  		</tbody>
		</table>	
	</div>
</div>