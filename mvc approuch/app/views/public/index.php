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
    <form method="POST" action="/post-comment">
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
        

        if (isset($array["error"]))
            echo "Database connection error";
        else
        {
            echo "<div class=\"num-of-comments\">" . count($array['comments']) . " Comments </div>";

            echo "<div class=\"comments\">";
          
            if (count($array['comments']) > 0)
            {
                foreach ($array["comments"] as $comment) {
                  echo '<div class="comment">';
                    echo '<div class="group">';
                        echo '<div class="name">' .$comment['name'] . '</div>';
                        echo '<div class="date">' . $comment['date_posted'] . '</div>';
                    echo '</div>';
                  echo '<div class="text">' . $comment['text'] . '</div>';
                  echo '</div>';
                } 
            }
            else
                echo '<div class="comment">No comments yet.</div>';

            echo "</div>";
        }
        
              
    ?>
</body>
</html>
