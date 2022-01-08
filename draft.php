<th>#</th>
					<th>Names</th>
					<th>ID&nbsp;Number</th>
					<th>Telephone</th>
					<th>Community</th>
					<th>Parish</th>
					<th>Diocese</th>
					<th>Village</th>
					<th>Cell</th>
					<th>Sector</th>
					<th>District</th>
					<th>Action</th>


					<table>
						<div class="label_user">
							<tr>
								<td><label>LastName:</label></td>
								<!-- <td><label><b></b></label></td> -->
								<td><label>FirstName:</label></td>
						    </tr>
						</div>
						<div class="input_user">
							<tr>
								<td><input type="text" name="lname" required></td>
								<!-- <td><input type="" name=""></td> -->
								<td><input type="text" name="fname" required></td>
							</tr>
						</div>
						<div class="label_user">
							<tr>
								<td><label>Telephone:</label></td>
								<!-- <td><label><b></b></label></td> -->
								<td><label>Designation:</label></td>
						    </tr>
						</div>
						<div class="input_user">
							<tr>
								<td><input type="number" name="phone" required></td>
								<!-- <td><input type="" name=""></td> -->
								<td>
									<select name="role" required>
										<option disabled selected>Choose&nbsp;Designation</option>
										<option>IT</option>
										<option>MD</option>
										<option>Volunteer&nbsp;Supervisor</option>
										<option>Volunteer</option>
									</select>
								</td>
							</tr>
						</div>
						<div class="submit_user">
							<tr>
								<td colspan="4"><input type="submit" name="enter_user" value="REGISTER&nbsp;USER"></td>
							</tr>
						</div>
						<caption>Users&nbsp;Registration&nbsp;Form</caption>
					</table>