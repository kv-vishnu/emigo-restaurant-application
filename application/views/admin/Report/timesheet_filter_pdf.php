<html>
<head>
  <title>Timesheet</title>
</head>
<body>
  <h1>Timesheet</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>No</th>
        <th>Client</th>
        <th>Technician</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
        
      <?php foreach ($data as $values) { ?>
        <tr>
        <td><?php echo $values['timesheet_id']; ?></td>
          <td><?php echo $values['timesheet_no']; ?></td>
          <td><?php echo $values['cl_name']; ?></td>
          <td><?php echo $values['tech_name']; ?></td>
          <td><?php echo $values['date']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
