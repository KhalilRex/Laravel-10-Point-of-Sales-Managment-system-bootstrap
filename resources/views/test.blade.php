
<html>
<h1>TESTING DATABASE</h1>
<form action="add" method="POST">
    @csrf
    <input type="text" name="Name" placeholder="Name"><br><br> 
    <input type="text" name="PhoneNumber" placeholder="Phone Number"><br><br> 
    <input type="email" name="Email" placeholder="Email"><br><br> 
    <input type="Password" name="Password" placeholder="Password"><br><br> 
    <input type="text" name="Country" placeholder="Country"><br><br> 
    <input type="text" name="Address" placeholder="Address"><br><br> 
    <input type="submit" name="submit" placeholder="submit">

</form>
</html>