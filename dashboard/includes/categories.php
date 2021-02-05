<?php
  include '../classes/includes.php';
  include 'content/restriction.php';
?>
<!DOCTYPE html>
<html>
  <title>Categories | Crystal Glow Skin Care </title>
  <?php include 'tags/header.php'; ?>

  <body>
    <?php include 'tags/menu.php'; ?>

    <section class="header3  mbr-fullscreen" style="padding-top:100px" id="header3-1">
        <div class="container">
          <div class="row">
            <div class="col-sm-8">
              <div class="item-container">
                <div class="item-header">
                  CATEGORIES
                </div>
                <div style="border-top:#333 thin solid; padding:5px">
                  <table style="width:100%">
                    <?php foreach($getCategories AS $categories){ ?>
                      <form method="post" action="">
                        <tr>
                          <td style="padding:10px; width:70%;">
                              <input type="hidden" name="catID" value="<?php echo $categories['catID']; ?>">
                              <input type="text" name="catName" value="<?php echo $categories['catName']; ?>" class="form-control">
                          </td>
                          <td style="padding:10px; width:30%;">
                            <input type="submit" name="editCat" class="btn btn-black" style="padding: 5px 5px 5px 5px" value="Edit" />
                            <input type="submit" name="deleteCat" class="btn btn-primary" style="padding: 5px 5px 5px 5px" value="Delete" />
                          </td>
                        </tr>
                      </form>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="item-container">
                <div class="item-header">
                  ADD CATEGORY
                </div>
                <div style="border-top:#333 thin solid; padding:10px">
                  <form method="post" action="">
                    Enter Category Name:
                    <input type="text" name="catName" class="form-control"><br />
                    <input type="submit" name="addCat" class="btn btn-black form-control" style="padding: 5px 5px 5px 5px" value="Add" />
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>


    <?php include 'tags/footer.php'; ?>


    <?php include 'tags/scripts.js' ?>


  </body>

</html>
