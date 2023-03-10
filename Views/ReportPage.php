
<!DOCTYPE html>
<html>

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
        margin-top:1em;
    }

    .form-step-title {
        text-align: center;
    }

    #form-tabs {
        display: flex;
        justify-content: center;
        margin: 0 auto;
    }

    .nav-buttons{
      margin-top: 3em;
      margin-bottom: 5em;
    }

    #footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 3.3rem;            /* Footer height */
    }

    #page-container {
      position: relative;
      min-height: 86vh;
    }

    .nav {
      display: flex;
      justify-content: space-between;
    }

    .nav li:nth-child(4){
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

</style>

<head>
    <title>Council Report Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/style.CSS">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <?php session_start();?>
</head>

<body>
  <nav style="position:sticky;z-index: 1100;">
    <!-- space and framework left to make navbar collapsable if needed -->
          <div class="">
            <ul class="nav">
              <li><a href="Index.html">Home</a></li>
              <li><a class="NavActive" href="ReportPage.php">Report Issue</a></li>
              <li><a href="ContactUs.html">Contact Us</a></li>
              <li class="mr-2" style="float:right;display: flex; justify-content: flex-end;"><a href="Index.html" id="NavSignIn">Sign In</a></li>
              <!-- <li style="float:right"><a href="AccountSettings.html">Account Settings</a></li> -->
              <li style="float:right;display: flex; justify-content: flex-end;"><input type="text" name="Search" value="" placeholder="Search"></li>
            </ul>
          </div>
  </nav>

  <div id="page-container">
    <div class="container" style="padding-bottom: 2.5rem;">
      <div>
          <h1 class="text-center mt-5">Report a Problem</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.</p>
      </div>

      <div class="mt-4" id="form-tabs">
        <div class="form-tab">Information</div>
        <div class="form-tab">Issue Type</div>
        <div class="form-tab">Issue Location</div>
        <div class="form-tab">Further Details</div>
      </div>

        <?php 
        try{
          error_reporting(E_ERROR | E_PARSE);
          $userID = $_SESSION['user_id'];
          if(is_null($userID)){
            $errorMessage = 'You must be logged in to create a report';
            echo "<h2 class='mt-5' style='margin:auto; text-align: center;'> $errorMessage </h2>";
          }
        }
        catch(Exception $e){
        }
        
        if($userID != null):
        ?>
      <form id="formCreateReport" method="POST">

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
          <button style="background-color: #8403fc; border: none;" class="next-button btn btn-primary" type="button">Next</button>
        </div>

        <div class="form-stage">
          <h1>Issue Type</h1>
          <label for="issueSelect">Dropdown List</label>
          <select name="issueSelect" class="form-control" style="width:30%" id="issueSelect">
              <option>Littering</option>
              <option>Graffiti</option>
              <option>Pothole</option>
              <option>Flooding</option>
              <option>Wrecked car</option>
              <option>Live wire</option>
              <option>Broken Streetlight</option>
          </select>
          <div class="mt-3">
              <button class="prev-button btn btn-secondary" type="button">Previous</button>
              <button style="background-color: #8403fc; border: none;" class="next-button btn btn-primary" type="button">Next</button>
          </div>
        </div>

        <div class="form-stage">
          <h1>Issue Location</h1>
          <div id="map-canvas" class="mt-3" style="height: 425px; width: 100%;"></div>
          <div class="mt-4" style="display:flex">
            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="lng" name="lng">
          </div>
          <div class="mt-3 nav-buttons">
              <button class="prev-button btn btn-secondary" type="button">Previous</button>
              <button style="background-color: #8403fc; border: none;" class="next-button btn btn-primary" type="button">Next</button>
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
              <textarea name="problemDescription" class="form-control" style="width:50%" id="problemDescription" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="image-upload" class="upload-label">
              <span><b>Upload photographic evidence here</b></span>
              <input id="image-upload" type="file" name="image-upload" multiple accept="image/*">
              <ul id="file-list"></ul>
            </label>
          </div>

          <div class="mt-3 nav-buttons">
          <button class="prev-button btn btn-secondary" type="button">Previous</button>
          <button style="background-color: #8403fc; border: none;" class="submit-button btn btn-primary" type="submit">Submit</button>
          </div>
        </div>
        
      </form>
      <script src="../JS/submitReport.js"></script>

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
  
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key=AIzaSyB61QLHLhzPTxEB9A3AJHCWwYz8caQq1Tg&libraries=places&region=GB'></script>

    <script>
      const input = document.querySelector('#image-upload');
      const fileList = document.querySelector('#file-list');

      input.addEventListener('change', () => {
        fileList.innerHTML = ''; // clear the previous file list
        for (const file of input.files) {
          const listItem = document.createElement('li');
          listItem.textContent = file.name;
          fileList.appendChild(listItem);
        }
      });
    </script>

    <script>
      let latInput = document.getElementById('lat');
      let lngInput = document.getElementById('lng');

      var mapCenter=new google.maps.LatLng(51.887912272257076,-2.0869772550118904);
      var mapOptions={
        zoom: 18,
        center: mapCenter,
        mapTypeId: google.maps.MapTypeId.HYBRID
      };
      var container=document.getElementById('map-canvas');
      var map=new google.maps.Map(container, mapOptions);

      var marker=new google.maps.Marker({
        position: mapCenter,
        map:map,
        title: 'Issue Location',
        draggable: true
      });
      var contentString = '<h1>Issue Location</h1>' + 'Please place this marker the location of the issue';

      marker.addListener('click', function(){
        infoWindow.open(map, marker);
      });
    
      var infoWindow= new google.maps.InfoWindow({
        content:contentString
      });

      marker.addListener('dragend', function(event){  
        var newLat = event.latLng.lat();
        var newLng = event.latLng.lng();
        latInput.value = newLat;
        lngInput.value = newLng;
        }
      );
    </script>

    <script>
        const form = document.getElementById('formCreateReport');
        const stages = document.getElementsByClassName('form-stage');
        const tabs = document.getElementsByClassName('form-tab');
        const nextButtons = document.getElementsByClassName('next-button');
        const prevButtons = document.getElementsByClassName('prev-button');

        let currentStage = 0;
        tabs[currentStage].classList.add('active');
        stages[currentStage].classList.add('active');

        for (let i = 0; i < nextButtons.length; i++) {
        nextButtons[i].addEventListener('click', () => {
            stages[currentStage].classList.remove('active');
            tabs[currentStage].classList.remove('active');

            currentStage++;
            stages[currentStage].classList.add('active');
            tabs[currentStage].classList.add('active');
        });
        }

        for (let i = 0; i < prevButtons.length; i++) {
        prevButtons[i].addEventListener('click', () => {
            stages[currentStage].classList.remove('active');
            tabs[currentStage].classList.remove('active');

            currentStage--;
            stages[currentStage].classList.add('active');
            tabs[currentStage].classList.add('active');
        });
        }
    </script>

    <script>
      function handleFormSubmission(event) {
        event.preventDefault();

        const form = document.getElementById('formCreateReport');
        const successMessage = document.getElementById('success-message');

        form.style.display = 'none';
        successMessage.style.display = 'block';
      }

      const form2 = document.getElementById('formCreateReport');
      form.addEventListener('submit', handleFormSubmission);
    </script>
 </body>
</html>