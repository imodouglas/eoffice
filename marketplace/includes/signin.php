<?php
  include '../classes/includes.php';
?>
<!DOCTYPE html>
<html>
  <title>Home</title>
  <?php include 'tags/header.php'; ?>

  <body>
    <?php include 'tags/menu.php'; ?>

    <section class="header3 mbr-fullscreen" id="header3-1">
        <div class="container" align="center">
          <div style="width:100%; max-width:400px">
            <h3 style="margin-bottom:30px">Login to your dashboard</h3>
            <form method="post" action="">
              <p>
                Username: <br />
                <input type="text" name="uname" class="form-control" />
              </p>
              <p>
                Password: <br />
                <input type="password" name="pword" class="form-control" />
              </p>
              <p>
                <input type="submit" name="login" value="Sign in" class="btn btn-primary form-control" />
              </p>
            </form>
          </div>
        </div>
    </section>


    <?php include 'tags/footer.php'; ?>


    <?php include 'tags/scripts.js' ?>


  </body>

</html>
