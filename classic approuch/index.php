<?php
    error_reporting(E_ERROR);
    include "connection.php";
    $error = false;
    
    // Check the database connection
    if ($conn->connect_error) 
      $error = true;
    
    if (!$error)
    {

        if ($_REQUEST['POST'])
        {
            if (isset($_POST['submit']) && isset($_POST['name'])
                                        && isset($_POST['email'])
                                        && isset($_POST['comment'])) {
                $name     = htmlspecialchars($_POST['name'],  ENT_QUOTES, 'UTF-8');
                $email    = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
                $comment  = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');

                
                $stmt = $conn->prepare("INSERT INTO comment (name, email, date_posted, text) VALUES (?, ?, CURDATE(), ?)");
                $stmt->bind_param("sss", $name, $email, $comment);
                $stmt->execute();


                $stmt->close();

            }
        }
    }
    
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Comment section</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles/comment.css">
  <link rel="stylesheet" type="text/css" href="styles/form.css">

</head>
<body>
  <h1>Comment System</h1>


  <div class="form">
    <form method="POST" action="index.php">
      <div class="form-group">
        <label>Email address</label>
        <input type="email" class="form-control" name="email" placeholder="name@example.com">
      </div>

      <div class="form-group">
        <label>Name:</label>
        <input type="text" class="form-control" name="name" placeholder="Name">
      </div>
    
      <div class="form-group">
        <textarea class="form-control" name="comment" rows="3" placeholder="Add a comment..."></textarea>
      </div>

      <button type="submit" name="submit" class="btn btn-primary mb-2">Comment</button>
    </form>
  </div>
  
  <?php 
      if (!$error)
        {
            $query = "SELECT * FROM comment";
            $result = $conn->query($query);

            echo "<div class=\"num-of-comments\">" . $result->num_rows . " Comments </div>";

            echo "<div class=\"comments\">";
          
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) 
                {
                  echo '<div class="comment">';
                    echo '<div class="group">';
                        echo '<div class="name">' . $row['name'] . '</div>';
                        echo '<div class="date">' . $row['date_posted'] . '</div>';
                    echo '</div>';
                  echo '<div class="text">' . $row['text'] . '</div>';
                  echo '</div>';
                }

            } else 
                echo '<div class="comment">No comments yet.</div>';
                

              echo "</div>";
              // Close the database connection
              $conn->close();

        }   
        else
            echo "Database connection error";
?>
</body>
</html>
