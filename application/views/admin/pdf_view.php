<html>
<head>
  <title>Clients</title>
</head>
<body>
  <h1>Clients</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>
        
      <?php foreach ($data as $values) { ?>
        <tr>
        <td><?php echo $values['id']; ?></td>
          <td><?php echo $values['name']; ?></td>
          <td><?php echo $values['email']; ?></td>
          <td><?php echo $values['phone']; ?></td>
          <td><?php echo $values['address']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
