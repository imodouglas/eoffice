<?php 
    if(isset($_POST['upWallet'])){
        if(getWalletct($conn,$userData['userID']) == 0){
            if(addWallet($conn,$userData['userID'],$_POST['bank'],$_POST['accountName'],$_POST['accountNo']) == 1){
                echo "<script> alert('Your bank details has been updated!'); window.location='home.php'; </script>";
            } else {
                echo "<script> alert('An error occured! Try again.'); window.location='home.php'; </script>";
            }
        } else {
            if(upWallet($conn,$userData['userID'],$_POST['bank'],$_POST['accountName'],$_POST['accountNo']) == 1){
                echo "<script> alert('Your bank details has been updated!'); window.location='home.php'; </script>";
            } else {
                echo "<script> alert('An error occured! Try again.'); window.location='home.php'; </script>";
            }
        }
    }
    $banks = array("Access Bank", "Citibank Nigeria", "Ecobank Nigeria", "Fidelity Bank", "First City Monument Bank", "First Bank of Nigeria", "Globus Bank", "Guaranty Trust Bank", "Heritage Bank", "Jaiz Bank", "Keystone Bank", "Polaris Bank", "Providus Bank", "Stanbic IBTC Bank", "Standard Chartered", "Sterling Bank", "SunTrust Bank Nigeria", "TAJBank", "Titan Trust Bank", "Union Bank of Nigeria", "United Bank for Africa", "Unity Bank", "Wema Bank", "Zenith Bank"); 
?>
<div id="bankInfo" style="display:none">
    <div class="eo-center eo-light-bg radius5 p20" style="position:fixed; max-width:400px;  z-index:3100" id="pubData" align="center">
        <button class="btn btn-light" style="padding:0px 3px; position:absolute; margin:-10px; right:20px" onclick='showWallet()'><i class="fas fa-times"></i></button>
        <?php if(getWalletct($conn,$userData['userID']) == 0){ ?>
            <h4 style="color:#070"> UPDATE BANK INFORMATION </h4>
            <form method="post" action="">
                <p class="mt10">
                    <select name="bank" class="form-control" required>
                        <option value=""> -- SELECT YOUR BANK -- </option>
                        <?php foreach($banks AS $bank){ 
                                echo "<option value='".$bank."' ".$selected."> ".$bank." </option>"; 
                            } 
                        ?>
                    </select>
                </p>
                <p class="mt10">
                    <input type="text" name="accountName" class="form-control" placeholder="Enter your account name" required />
                </p>
                <p class="mt10">
                    <input type="number" name="accountNo" class="form-control" placeholder="Enter your account number" required />
                </p>
                <p class="mt10">
                    <input type="submit" name="upWallet" class="btn btn-primary w100" value="Update Info" />
                </p>
            </form>
        <?php } else { ?>
            <div id="bankDisplay" style="display:block">
                <h4 style="color:#070"> YOUR BANK INFORMATION </h4>
                <p class="mt10"> <?php echo getWallet($conn,$userData['userID'])['bankName']; ?> </p>
                <p class="mt10"> <?php echo getWallet($conn,$userData['userID'])['accountName']; ?> </p>
                <p class="mt10"> <?php echo getWallet($conn,$userData['userID'])['accountNo']; ?> </p>
                <p> <a href="#" onclick="editWallet()"> <i class="fas fa-edit"></i>&nbsp; Edit Info </a> </p>
            </div>
            <div id="bankForm" style="display:none">
                <form method="post" action="">
                    <p class="mt10">
                        <select name="bank" class="form-control" required>
                            <option value=""> -- SELECT YOUR BANK -- </option>
                            <?php foreach($banks AS $bank){ 
                                if(getWallet($conn,$userData['userID'])['bankName'] == $bank){ $selected = 'selected'; } else { $selected = ""; }
                                    echo "<option value='".$bank."' ".$selected."> ".$bank." </option>"; 
                                } 
                            ?>
                        </select>
                    </p>
                    <p class="mt10">
                        <input type="text" name="accountName" class="form-control" value="<?php echo getWallet($conn,$userData['userID'])['accountName']; ?>" placeholder="Enter your account name" required />
                    </p>
                    <p class="mt10">
                        <input type="number" name="accountNo" class="form-control" value="<?php echo getWallet($conn,$userData['userID'])['accountNo']; ?>" placeholder="Enter your account number" required />
                    </p>
                    <p class="mt10">
                        <input type="submit" name="upWallet" class="btn btn-primary w100" value="Update Info" />
                    </p>
                    <p> <a href="#" onclick="editWallet()"> <i class="fas fa-arrow-left"></i>&nbsp; Go back </a> </p>
                </form>
            </div>
        <?php } ?>
    </div>
    <div class="eo-center eo-dark-bg w100" style="position:fixed; height:100vh; opacity:0.8; z-index:3000"></div>
</div>

<div id="doCashout" style="display:none">
    <div class="eo-center eo-light-bg radius5 p20" style="position:fixed; max-width:400px;  z-index:3100" id="pubData" align="center">
        <button class="btn btn-light" style="padding:0px 3px; position:absolute; margin:-10px; right:20px" onclick='doCashout()'><i class="fas fa-times"></i></button>
        <h4 style="color:#070"> REQUEST CASHOUT </h4>
        <form method="post" action="" id="coForm">
            <input type="hidden" name="userID" value="<?php echo $_SESSION['eo_user_session']; ?>"; />
            <p class="mt10">
                <input type="number" name="coAmount" id="coAmount" class="form-control" placeholder="Enter an amount" required />
                <span style="color:red" id="coerror1"></span>
            </p>
            <p class="mt10" id="coBtn">
                <input type="submit" name="doCashout" class="btn btn-primary w100" value="Request Cashout" />
            </p>
        </form>
    </div>
    <div class="eo-center eo-dark-bg w100" style="position:fixed; height:100vh; opacity:0.8; z-index:3000"></div>
</div>