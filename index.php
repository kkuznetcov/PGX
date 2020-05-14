<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>PharmacoGenomeX2 - форма</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/form.css">
</head>

<body>
  <?php include './config.php'; ?>
  <!-- форма -->
  <!-- шаг 1 -->
  <form action="report.php" method="POST" target="_blank" id="pdf-form">

    <section class="" id="">
      <br>
      <div class="container">
        <h2>/Шаг 1</h2>
        <h2>Insert the Data</h2>
        <p>Do not change the genotype, if you don’t know it ("wild" types is default).</p><br>

        <!-- выбираем направление  -->

        <div class="row">
          <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <?php
                $statement = $pdo->prepare("SELECT * FROM category");
                $statement->execute();
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach($data as $key => $value):?>
                  <a class="nav-link <?php if ($key == 0){echo 'active';} ?>" id="v-pills-home-tab" data-toggle="pill"
                    href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" data-category-id="<?php echo $value['idCategory']; ?>"><?php echo $value['name']; ?>&rarr;</a>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- выбираем маркер -->
          <div class="col-6">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="row">
                  <div class="col-4 list-group__container">
                  </div>
                  <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><br>
        <!-- 
        <button type="button" class="btn btn-outline-secondary" href="#">&larr; Назад</button>
        <button type="button" class="btn btn-outline-success" href="#">Дальше &rarr;</button>
        -->
      </div>
      </div>

      </div>
      </div>

      </div><br>
    </section>

  <!-- Шаг 2 -->

  <section class="" id="">
    <div class="container">
      <h2>/Шаг 2</h2>
      <h3>Choose the Groups of Drugs</h3><br>
      
        <style>
        .someclass {
          background-color: #4B7872;
          color: #FFFFFF;
          width: 240px;
          margin: 5px 10px 5px 1px;
        }
      </style>
      
      <!-- кнопка -->
      <input class="checkbox__modal" type="checkbox" name="psychiatry">
      <button type="button" class="btn someclass" data-toggle="modal" data-target="#psychiatry" data-specialization-name="psychiatry"> PSYCHIATRY
      </button>
      <input class="checkbox__modal" type="checkbox" name="neurology">
      <button type="button" class="btn someclass" data-toggle="modal" data-target="#neurology" data-specialization-name="neurology"> NEUROLOGY
      </button>
      <input class="checkbox__modal" type="checkbox" name="cardiology">
      <button type="button" class="btn someclass" data-toggle="modal" data-target="#cardiology" data-specialization-name="cardiology"> CARDIOLOGY
      </button><br>
       <input class="checkbox__modal" type="checkbox" name="allergology">
      <button type="button" class="btn someclass" data-toggle="modal" data-target="#allergology" data-specialization-name="allergology"> ALLERGOLOGY
      </button>
       <input class="checkbox__modal" type="checkbox" name="gastroenterology">
      <button type="button" class="btn someclass" data-toggle="modal" data-target="#gastroenterology" data-specialization-name="gastroenterology">
        GASTROENTEROLOGY
      </button>
      <input class="checkbox__modal" type="checkbox" name="endocrinology">
      <button type="button" class="btn someclass" data-toggle="modal" data-target="#endocrinology" data-specialization-name="endocrinology"> ENDOCRINOLOGY
      </button><br>
      <input class="checkbox__modal" type="checkbox" name="dermatology">
      <button type="button" class="btn someclass" data-toggle="modal" data-target="#dermatology" data-specialization-name="dermatology"> DERMATOLOGY
      </button>
      <input class="checkbox__modal" type="checkbox" name="infections">
      <button type="button" class="btn someclass" data-toggle="modal" data-target="#infections" data-specialization-name="infections"> INFECTIONS
      </button>
      <input class="checkbox__modal" type="checkbox" name="oncology">
      <button type="button" class="btn someclass" data-toggle="modal" data-target="#oncology" data-specialization-name="oncology"> ONCOLOGY
      </button>

      <!-- окно -->
      <?php 
        $statement = $pdo->prepare("SELECT * FROM category");
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $key => $value):
      ?>

      <?php endforeach; ?>
      <div class="modals">
          
      </div>
      
        <br><br>

  </section>
  <br><br>
  <!-- шаг 3 -->

  <section class="" id="user-info">
    <div class="container">
      <h2>/Шаг 3</h2>
      <h3>Information about patient and organzation</h3>
      <small id="" class="form-text text-muted">fields marked with * are required</small>
      <br>

      <div class="form-group">
        <label for="InputId">ID*</label>
        <input type="text" name="InputId" class="form-control" id="" aria-describedby="" placeholder="" value="ID">
      </div>

      <div class="form-group">
        <label for="InputSurname">Фамилия*</label>
        <input type="text" name="InputSurname" class="form-control" id="" aria-describedby="" placeholder="" value="Иванов">
      </div>

      <div class="form-group">
        <label for="InputFirstName">Имя*</label>
        <input type="text" name="InputFirstName" class="form-control" id="" aria-describedby="" placeholder="" value="Иван">
      </div>

      <div class="form-group">
        <label for="InputSecondName">Отчество*</label>
        <input type="text" name="InputSecondName" class="form-control" id="" aria-describedby="" placeholder="" value="Иванович">
      </div>

      <div class="form-group">
        <label for="InputBirth">Дата рождения*</label>
        <input type="text" name="InputBirth" class="form-control" id="" aria-describedby="" placeholder="" value="01/01/1980">
      </div>

      <div class="form-group">
        <label for="InputHeight">Рост (см)*</label>
        <input type="text" name="InputHeight" class="form-control" id="" aria-describedby="" placeholder="" value="180">
      </div>

      <div class="form-group">
        <label for="InputWeight">Вес (кг)*</label>
        <input type="text" name="InputWeight" class="form-control" id="" aria-describedby="" placeholder="" value="80">
      </div>

      <div class="form-group">
        <label for="InputSex">Пол (м/ж)*</label>
        <input type="text" name="InputSex" class="form-control" id="" aria-describedby="" placeholder="" value="м">
      </div>

      <div class="form-group">
        <label for="InputRase">Раса*</label>
        <input type="text" name="InputRase" class="form-control" id="" aria-describedby="" placeholder="" value="Европеоид">
      </div>

      <div class="form-group">
        <label for="InputDate">Дата*</label>
        <input type="date" name="InputDate" class="form-control" id="davaToday" aria-describedby="" placeholder="" value="">
      </div>
      
      <div class="form-group">
        <label for="InputNameDoctor">Имя доктора</label>
        <input type="text" name="InputNameDoctor" class="form-control" id="" aria-describedby=""
          placeholder="" value="Застрожин Михаил Сергеевич, к.м.н.,
руководитель лаборатории генетики МНПЦ наркологии ДЗМ">
      </div>
    </div>
  </section>
  
  <?php 
  $CurrentDate = date('j/m/Y');
  ?>

  <br><br>
  <!-- шаг 4 -сформировать отчет -->

  <section class="" id="">
    <div class="container">
      <!--<h2>/Шаг 4</h2>
      <h3>Generation of Report</h3>-->
      <br>
<!--
     <a href="#" class="btn btn-dark btn-lg btn-block" role="button"
        style="background-color: #4B7872; color: #FFFFFF; border: solid 1px #4B7872;">Сформировать
        отчет</a>
        --> 

        <input type="submit" value="Сформировать отчет" id="generate-pdf1">
        <br>
      
    </div>
  </section>
  </form>


  <form action="report2.php" method="POST" target="_blank" id="form-send">
      <input type="hidden" name="formData" id="formData">
      <input type="hidden" name="columns" id="columns">
      <input type="hidden" name="drugs" id="drugs">
  </form>

  <!--  -->
  <style>
    .panel {
      padding: 0 20px;
      background-color: #FFFFFF;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.2s ease-out;
    }
  </style>
  
  <!-- текущая дата в поле -->
  <script>
document.getElementById('davaToday').valueAsDate = new Date();
</script>

  <script>
    document.addEventListener('click', (e) => {
      // 
      if(e.target && e.target.className == 'accordion'){
        e.preventDefault();
        let panel = e.target.nextElementSibling;

        if (panel.style.maxHeight) {
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        }
      }
    });
  </script>

  <!--  конец формы -->

  <!-- JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.2/jspdf.plugin.autotable.min.js"></script>
  <!-- <script src="js/o-0IIpQlx3QUlC5A4PNr6DRAW_0-normal.js"></script> -->
  <script src="js/form.js"></script>
  <script src="js/app.js" async></script>

</body>

</html>