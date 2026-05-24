<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Siswa</title>

  <!-- ICON -->
  <!-- <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> -->

  <style>
    /* body{
      background:#e9e9e9;
      display:flex;
      justify-content:center;
      align-items:center;
      min-height:100vh;
    } */

    .container{
      /* width:380px; */
      background: white;
      /* min-height:100vh; */
      position:relative;
      padding: 0 20px;
      text-align:center;
    }

    /* PROFILE */
    .profile-img{
      width:130px;
      height:130px;
      border-radius:50%;
      object-fit:cover;
      /* margin-top:20px; */
    }

    .title{
      /* margin-top:15px; */
      font-size:22px;
      letter-spacing:1px;
    }

    /* CARD */
    .card{
      background: #f3de92;
      /* margin-top:60px; */
      border-radius:30px;
      padding:35px 20px;
    }

    .item{
      display:flex;
      justify-content:space-between;
      align-items:center;
      padding:15px 0;
      border-bottom:4px solid #f0f0f0;
      font-size:18px;
    }

    .item i{
      cursor:pointer;
      transition:0.3s;
    }

    .item i:hover{
      color:#555;
      transform:scale(1.1);
    }

    .logout{
      margin-top:30px;
    }

    .logout a{
      text-decoration:underline;
      color:black;
      font-size:20px;
      font-weight:bold;
    }

    /* NAVBAR */
    /* .navbar{
      position:absolute;
      bottom:20px;
      left:50%;
      transform:translateX(-50%);
      width:320px;
      background:#5f7d9c;
      border-radius:40px;
      padding:18px 10px;
      display:flex;
      justify-content:space-around;
      align-items:center;
    }

    .navbar i{
      color:#f1f1f1;
      font-size:28px;
      cursor:pointer;
    }

    .profile-icon{
      background:#f5e08a;
      width:55px;
      height:55px;
      border-radius:50%;
      display:flex;
      justify-content:center;
      align-items:center;
    }

    .profile-icon i{
      color:black;
      font-size:28px;
    } */

  </style>
</head>
<body>

  <div class="container">

    <!-- FOTO PROFILE -->
    <img src="../picture/user-profile.jpg" alt="profile" class="profile-img">
    <h2 class="title">PROFILE SISWA</h2>

    <!-- CARD -->
    <div class="card">

      <div class="item">
        <span>username</span>
        <a href="#"><img src="../picture/edit-text.png" alt="edit" width="20px"></a>
      </div>

      <div class="item">
        <span>email</span>
        <a href="#"><img src="../picture/edit-text.png" alt="edit" width="20px"></a>
      </div>

      <div class="item">
        <span>password</span>
        <a href="#"><img src="../picture/edit-text.png" alt="edit" width="20px"></a>
      </div>

      <div class="logout">
        <a href="#">LOGOUT</a>
      </div>
  </div>
</div>
</body>
</html>