<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verileri getir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Popup (arka plan) */
.modal {
    display: none; /* Varsayılan olarak gizlidir */
    position: fixed; /* Yerinde kal */
    z-index: 1; /* Üstte */
    left: 0;
    top: 0;
    width: 100%; /* Ful Genişlik */
    height: 100%; /* Ful Yükseklik */
    overflow: auto; /* Gerekirse kaydırmayı etkinleştir */
    background-color: rgb(0,0,0); /* Yedek renk */
    background-color: rgba(0,0,0,0.4); /* Siyah w / opaklık */
}

/* İçerik / Kutu */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* % 15 üstten ve ortalanmış */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Ekran boyutuna bağlı olarak daha fazla veya daha az olabilir */
}

/* Kapat Düğmesi */
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
    
    <div class="container mt-5">
        <br>
        <div class="table-responsive mt-5">
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
            @foreach($veriler as $veri)
            <tr>
                <td scope="row">{{ $veri['id'] }}</td>
                <td>{{ $veri['name'] }}</td>
                <td>{{ $veri['desc'] }}</td>
                <td>{{ $veri['miktar'] }}</td>
                
                <td>
                  <button class="d-inline" style="background: none; border:0;" onclick="openModal('{{ $veri['id'] }}', '{{ $veri['name'] }}', '{{ $veri['desc'] }}', '{{ $veri['miktar'] }}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" style="color: blue" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                  </button>
                  <form class="d-inline" action="http://127.0.0.1:8000/api/item/delete/{{ $veri['id'] }}" method="post">
                      <button style="background: none; border:0;" type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" style="color: red" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                              <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                          </svg>
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    </div>
    <center>
    <a href="http://127.0.0.1:8001/urunekle"><button class="btn btn-success">Yeni ürün ekle</button></a>

    
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container p-2">
        <form id="updateForm" method="POST">
          <div class="mb-3">
            <input class="form-control" type="text" name="id" placeholder="Öğe İdsi" readonly />
          </div>
          <div class="mb-3">
            <input class="form-control" type="text" name="name" placeholder="Öğe Adı" />
          </div>
          <div class="mb-3">
            <input class="form-control" type="text" name="desc" placeholder="Öğe Açıklaması" />
          </div>
          <div class="mb-3">
            <input class="form-control" type="number" name="miktar" placeholder="Miktarı" />
          </div>
          <button type="submit" class="btn btn-warning">Güncelle</button>
          <a href="http://127.0.0.1:8001/getir"><button type="button" class="btn btn-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" style="margin-top:-5px;" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg> Listeye dön
          </button></a>
        </form>
      </div>
  </div>
</div>
    </div>

</center>

<script>
const form = document.getElementById('updateForm');
    
    form.addEventListener('submit', (event) => {
      event.preventDefault(); 
      const id = document.querySelector('input[name="id"]').value;
      const actionUrl = `http://127.0.0.1:8000/api/item/update/${id}`;
      form.action = actionUrl;
      form.submit();
      alert('Güncellendi!');
    });



  function openModal(id, name, desc, miktar) {
    var modal = document.getElementById('myModal');
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
  
  // Popup Al
  var modal = document.getElementById('myModal');

  // Kipi kapatan <span> öğesini edinin
  var span = document.getElementsByClassName("close")[0];

  // Kullanıcı <span> (x) düğmesini tıkladığında, popup
  span.onclick = function() {
      modal.style.display = "none";
  }

  // Kullanıcı modelden başka herhangi bir yeri tıklattıysa, onu kapatın.
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
</script>

</body>
</html>
