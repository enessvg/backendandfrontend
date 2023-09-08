<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Verileri getir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
  <style>
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 6.5% auto;
      padding: 20px;
      border: 2px solid #ffc107 !important;
      width: 50%;
    }

    @media screen and (max-width:965px) {
      .modal-content {
        background-color: #fefefe;
        margin: 7% auto;
        padding: 20px;
        border: 2px solid #ffc107 !important;
        width: 80%;
      }
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->

        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="/home">Anasayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/urunekle">Ürün Ekle</a>
          </li>

        </ul>
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->

      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <!-- Icon -->

        <!-- Avatar -->
        <div class="dropdown">
          <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar"
            role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img src="https://d2gg9evh47fn9z.cloudfront.net/800px_COLOURBOX25634105.jpg" class="rounded-circle"
              height="30" alt="Black and White Portrait of a Man" loading="lazy" />
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
            <form action="{{ route('logout') }}" method="GET">
              @csrf
              <li><button type="submit" class="dropdown-item">Çıkış</button></li>
            </form>
          </ul>
        </div>
      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->



  <div class="container">
    <center><a href="http://127.0.0.1:8001/urunekle"><button class="btn btn-success mt-4">Yeni ürün ekle</button></a>
    </center>
    <br>
    @if ($errors->has('delete'))
    <div id="alert-message" class="alert alert-success m-3" style="margin-bottom: -30px;" role="alert">
      {{ $errors->first('delete') }}
    </div>
    @endif
    @if ($errors->has('statusok'))
    <div id="alert-message" class="alert alert-success m-3" style="margin-bottom: -30px;" role="alert">
      {{ $errors->first('statusok') }}
    </div>
    @endif
    @if ($errors->has('statuserror'))
    <div id="alert-message" class="alert alert-danger m-3" style="margin-bottom: -30px;" role="alert">
      {{ $errors->first('statuserror') }}
    </div>
    @endif

    <div class="table-responsive">
      <table class="table table-bordered border-danger">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">İsmi</th>
            <th scope="col">Açıklama</th>
            <th scope="col">Miktar</th>
            <th scope="col">İşlemler</th>
          </tr>
        </thead>
        <tbody>
          @if ($veriler)
          @foreach($veriler as $veri)
          <tr>
            <td scope="row">{{ $veri['id'] }}</td>
            <td>{{ $veri['name'] }}</td>
            <td>{{ $veri['desc'] }}</td>
            <td>{{ $veri['miktar'] }}</td>
            <td>

              <button class="d-inline" style="background: none; border: 0;"
                onclick="openModal('{{ $veri['id'] }}', '{{ $veri['name'] }}', '{{ $veri['desc'] }}', '{{ $veri['miktar'] }}')">
                <i class="fa-regular fa-pen-to-square text-warning"></i>
              </button>

              <form class="d-inline"
                onclick="return window.confirm('{{ $veri['id'] }} ID numarlı\n{{ $veri['name'] }} isimli ürünü\nSilmek istediğinize emin misiniz?');"
                action="{{ route('sil', ['id' => $veri['id']]) }}" method="post">
                @csrf
                @method('DELETE')
                <button style="background: none; border:0;" type="submit">
                  <i class="fa-regular fa-trash-can text-danger"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>

    <center>

      <div id="myModal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-warning">Ürünü Güncelle</h5>
            <span class="close">&times;</span>
          </div><br>
          <div class="container">
            <form id="myForm" action="{{ route('guncelle', ['id' => $veri['id']]) }}" method="POST" onsubmit="return validateForm()">
              @csrf
              <div class="mb-3">
                <input class="form-control" type="text" name="id" value="{{ $veri['id'] }}" readonly />
              </div>
              <div class="mb-3">
                <input class="form-control" type="text" name="name" placeholder="Öğe Adı" value="{{ $veri['name'] }}" />
                @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <input class="form-control" type="text" name="desc" placeholder="Öğe Açıklaması"
                  value="{{ $veri['desc'] }}" />
                @error('desc')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <input class="form-control" type="number" name="miktar" placeholder="Miktarı"
                  value="{{ $veri['miktar'] }}" />
                @error('miktar')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>
              <button type="submit" class="btn btn-warning">Güncelle</button>
              <a href="/home">
                <button type="button" class="btn btn-secondary mt-2">
                  <i class="bi bi-arrow-left-circle"></i> Listeye dön
                </button>
              </a>
            </form>
          </div>
        </div>
      </div>

  </div>
  </center>

    
    


  <script>
     function validateForm() {
     const nameInput = document.querySelector('input[name="name"]');
     const descInput = document.querySelector('input[name="desc"]');
     const miktarInput = document.querySelector('input[name="miktar"]');
     if (nameInput.value.trim() === '' && descInput.value.trim() === '' && miktarInput.value.trim() === '') {
       alert('Tüm alanlar boş bırakılamaz.');
       return false;
     }
     if (nameInput.value.trim() === '' && descInput.value.trim() === '') {
       alert('Öğe Adı ve Öğe Açıklaması boş bırakılamaz.');
       return false;
     }
     if (nameInput.value.trim() === '' && miktarInput.value.trim() === '') {
       alert('Öğe Adı ve Miktarı boş bırakılamaz.');
       return false;
     }
     if (descInput.value.trim() === '' && miktarInput.value.trim() === '') {
       alert('Öğe Açıklaması ve Miktarı boş bırakılamaz.');
       return false;
     }
     if (nameInput.value.trim() === '') {
       alert('Öğe Adı boş bırakılamaz.');
       return false;
     }
     if (descInput.value.trim() === '') {
       alert('Öğe Açıklaması boş bırakılamaz.');
       return false;
     }
     if (miktarInput.value.trim() === '') {
       alert('Miktarı boş bırakılamaz.');
       return false;
     }
     return true;
   }
    const myForm = document.getElementById('myForm');
    function openModal(id, name, desc, miktar) {
        var modal = document.getElementById('myModal');
        var form = modal.querySelector('form');
        var action = form.getAttribute('action');
        var updatedAction = action.split('/');
        updatedAction[updatedAction.length - 1] = id;  //CHATGPT
        form.setAttribute('action', updatedAction.join('/'));

        var idInput = document.querySelector('input[name="id"]');
        var nameInput = document.querySelector('input[name="name"]');
        var descInput = document.querySelector('input[name="desc"]');
        var miktarInput = document.querySelector('input[name="miktar"]');

        idInput.value = id;
        nameInput.value = name;
        descInput.value = desc;
        miktarInput.value = miktar;

        modal.style.display = "block";
    }


  var modal = document.getElementById('myModal');

  var span = document.getElementsByClassName("close")[0];


  span.onclick = function() {
      modal.style.display = "none";
  }

  // // Model dışında tıklarsa modalı kapatan kod
  // window.onclick = function(event) {
  //     if (event.target == modal) {
  //         modal.style.display = "none";
  //     }
  // }

  
  setTimeout(function() {
  var alertMessage = document.getElementById('alert-message');
  if (alertMessage) {
    alertMessage.style.display = 'none';
  }
}, 2000); 




  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>


</body>

</html>