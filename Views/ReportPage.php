<!DOCTYPE html>
<html>

<head>
  <title>Create Report</title>
  <link rel="stylesheet" type="text/css" href="../CSS/Style.CSS">
</head>

<style>
  #form-tabs {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .form-tab {
    width: 33.3%;
    padding: 10px;
    border: 1px solid black;
  }

  .form-tab.active {
    border: 2px solid #8403fc;
  }

  .form-stage {
    display: none;
  }

  .form-stage.active {
    display: block;
  }

  form {
    display: flex;
    flex-direction: column;
    margin-top: 1em;
  }

  .form-step-title {
    text-align: center;
  }

  #form-tabs {
    display: flex;
    justify-content: center;
    margin: 0 auto;
  }

  .nav-buttons {
    margin-top: 3em;
    margin-bottom: 5em;
  }

  #footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 3.3rem;
  }

  #page-container {
    position: relative;
    min-height: 86vh;
  }

  .nav {
    display: flex;
    justify-content: space-between;
  }

  .nav li:nth-child(4) {
    margin-left: auto;
  }

  .nav li {
    display: flex;
    align-items: center;
  }

  @media (max-width: 767px) {
    .container {
      margin-top: 100px;
    }
  }

  .upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100px;
    width: 50%;
    border: 2px dashed #ccc;
    font-size: 18px
  }

  .upload-label span {
    display: block;
    margin-bottom: 10px;
  }

  #image-upload {
    display: none;
  }

  .upload-label:hover {
    cursor: pointer;
    border-color: #aaa;
  }

  .upload-label:hover span {
    color: #aaa;
  }

  .upload-label:focus-within {
    outline: 2px dotted #aaa;
  }

  .review-label {
    font-weight: bold;
    display: block;
  }

  .review-value {
    display: block;
  }

  #issue-stage {
    display: flex;
    align-items: center;
  }

  #issueSelect {
    margin-right: 10px;
  }

  #image-preview img {
    max-width: 500px;
    max-height: 500px;
    margin: 5px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 2);
  }
</style>

<head>
  <title>Council Report Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/style.CSS">

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type='text/javascript'
    src='https://maps.google.com/maps/api/js?language=en&key=AIzaSyB61QLHLhzPTxEB9A3AJHCWwYz8caQq1Tg&libraries=places&region=GB'></script>

  <?php session_start(); ?>
</head>

<body>
  <nav style="position:sticky;z-index: 1100;">
    <!-- space and framework left to make navbar collapsable if needed -->
    <div class="">
      <ul class="nav">
        <li><a href="Index.html">Home</a></li>
        <li><a class="NavActive" href="ReportPage.php">Report Issue</a></li>
        <li><a href="ContactUs.html">Contact Us</a></li>
        <li><a href="view-problems.html">View Problems</a></li>
        <li id="NavSignIn" style="float:right"><a class="NavActive" href="login.html" id="NavSignIn">Sign In</a></li>
        <li style="float:right"><a href="javascript:logout()" id="NavSignOut">Sign Out</a></li>
        <li style="float:right;display: flex; justify-content: flex-end;"><input type="text" name="Search" value=""
            placeholder="Search"></li>
      </ul>
    </div>
  </nav>

  <div id="page-container">
    <div class="container">
      <div>
        <h1 class="text-center mt-5">Report a Problem</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
          magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
          et dolore
          magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
          et dolore
          magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat.</p>
      </div>

      <div class="mt-4" id="form-tabs">
        <div class="form-tab">Information</div>
        <div class="form-tab">Issue Type</div>
        <div class="form-tab">Issue Location</div>
        <div class="form-tab">Further Details</div>
        <div class="form-tab">Review Information</div>
      </div>

      <?php
      try {
        error_reporting(E_ERROR | E_PARSE);
        $userID = $_SESSION['user_id'];
        if (is_null($userID)) {
          $errorMessage = 'You must be logged in to create a report';
          echo "<h2 class='mt-5' style='margin:auto; text-align: center;'> $errorMessage </h2>";
        }
      } catch (Exception $e) {
      }

      if ($userID != null):
        ?>
        <form id="formCreateReport" method="POST" enctype="multipart/form-data">

          <input type="hidden" id="userId" name="userId" value="<?php echo $_SESSION['user_id']; ?>">

          <div class="form-stage">
            <h1>Information</h1>
            <p>Use this service to report an issue in your local area. You'll need to provide:</p>
            <ul>
              <li>The exact address or location of the issue</li>
              <li>A description of the issue</li>
              <li>Photos</li>
              <li>Your name (optional)</li>
              <li>Your contact details (optional)</li>
            </ul>
            <button style="background-color: #8403fc; border: none;" class="next-button btn btn-primary"
              type="button">Next</button>
          </div>

        <div class="form-stage">
          <h1>Issue Type</h1>
          <label for="issueSelect">Dropdown List</label>
          <select name="issueSelect" class="form-control" style="width:30%" id="issueSelect">
              <option>Broken traffic lights</option>
              <option>Burst pipe</option>
              <option>Blocked drain</option>
              <option>Broken streetlight</option>
              <option>Exposed cables</option>
              <option>Flooding</option>
              <option>Graffiti</option>
              <option>Litter</option>
              <option>Pothole</option>
              <option>Wrecked car</option>
              <option>Other</option>
            </select>

            <div>
              <label for="otherIssue" id="otherLabel" style="display:none;" class="mt-4">Please describe your
                issue</label>
              <textarea name="otherIssue" class="form-control" style="display:none; width:50%" id="otherIssue" rows="3"
                oninput="document.getElementById('otherValue').innerHTML = this.value.replace(/\n/g, '<br>')"></textarea>
            </div>
            <div class="mt-3 mb-5">
              <button class="prev-button btn btn-secondary" type="button">Previous</button>
              <button style="background-color: #8403fc; border: none;" class="next-button btn btn-primary"
                type="button">Next</button>
            </div>
          </div>

          <div class="form-stage">
            <h1>Issue Location</h1>
            <div id="map-canvas1" class="mt-3" style="height: 425px; width: 100%;"></div>
            <div class="mt-4" style="display:flex">
              <input type="hidden" id="lat" name="lat">
              <input type="hidden" id="lng" name="lng">
            </div>
            <div class="mt-3 nav-buttons">
              <button class="prev-button btn btn-secondary" type="button">Previous</button>
              <button style="background-color: #8403fc; border: none;" class="next-button btn btn-primary"
                type="button">Next</button>
            </div>
          </div>

          <div class="form-stage">
            <h1>Further Details</h1>
            <div class="form-group">
              <label for="problemDescription">
                Please give as much information as you can about: <br>
                <ul>
                  <li>What the issue is</li>
                  <li>The size of the issue </li>
                  <li>How long you think the issue has been there </li>
                  <li>Any risks caused by the issue </li>
                  <li>Relevant landmarks or points of reference</li>
                </ul>
              </label>
              <textarea name="problemDescription" class="form-control" style="width:50%" id="problemDescription" rows="3"
                oninput="document.getElementById('descriptionValue').innerHTML = this.value.replace(/\n/g, '<br>')"></textarea>
            </div>
            <div class="form-group">
                <span class="mr-1"><b>Upload photographic evidence here</b></span>
                <label for="image-upload"></label>
                <input class="form-control" type="file" id="image-upload" name="images[]" multiple>
                <button type="button" onclick="document.getElementById('image-upload').click()">Choose file(s)</button>
                <br>
                <span style="font-style: italic;" class="max-images-message">(A maximum of 6 images are allowed)</span>
                <div class="mt-3" id="name-preview"></div>
            </div>
            <div class="mt-3 nav-buttons">
              <button class="prev-button btn btn-secondary" type="button">Previous</button>
              <button style="background-color: #8403fc; border: none;" class="description-button next-button btn btn-primary"
                type="button">Next</button>
            </div>
          </div>

          <div class="form-stage">
            <h1>Review Information</h1>

            <div class="mt-3 mb-5">
              <label class="review-label">Problem Type:</label>
              <span class="review-value" id="typeValue"></span>
            </div>

            <div class="mb-5">
              <label style="display:none" class="review-label" id="otherDesTitle">Other:</label>
              <span style="display:none" class="review-value" id="otherValue"></span>
            </div>

            <div class="mb-5">
              <label class="review-label">Further details:</label>
              <span class="review-value" id="descriptionValue"></span>
            </div>

            <div class="mb-5">
              <label class="review-label">Issue Location:</label>
              <div id="map-canvas2" class="mt-3" style="height: 425px; width: 100%;"></div>
            </div>

            <div class="mb-5">
              <label class="review-label">Photographic evidence:</label>
              <div id="image-preview"></div>
            </div>

            <div class="mt-3 nav-buttons">
              <button class="prev-button btn btn-secondary" type="button">Previous</button>
              <button style="background-color: #8403fc; border: none;" class="submit-button btn btn-primary"
                type="submit">Submit</button>
            </div>
          </div>

        </form>

        <div id="success-message" style="display: none;">
          <h1 class="mt-5">Thank you for bringing this issue to our attention!</h1>
        </div>
      </div>
    <?php endif;
      ?>

    <footer id="footer">
      <div class="" style="width:45%;">
        <a href="ContactUs.html">Contact Us</a><br>
        Report a bug: CheltBugReport@email.com
      </div>
      <div class="" style="width:45%;">
        Made by TEMA TEMA inc
      </div>
      <div class="" style="width:10%;">
        <img src="../Images/tematemalogo.png" height="40px" width="40px">
      </div>
    </footer>
  </div>


  <?php
  try {
    error_reporting(E_ERROR | E_PARSE);
    $userID = $_SESSION['user_id'];
  } catch (Exception $e) {
  }
  if ($userID != null):
    echo "<script src='../JS/Common.js'></script>";
    echo "<script src='../JS/submitReport.js'></script>";
    echo "<script src='../JS/reportFormHide.js'></script>";
    echo "<script src='../JS/reportFormOther.js'></script>";
    echo "<script src='../JS/reportFormTabs.js'></script>";
    echo "<script src='../JS/imagePreview.js'></script>";
  endif;
  ?>

</body>

</html>