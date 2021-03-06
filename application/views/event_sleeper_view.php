
    <link href="<?php echo base_url('assets/admin'); ?>/css/seat/bootstrap.css" rel="stylesheet"/>
    
    
    
   <style>

input[type=checkbox] {
  visibility: hidden;
}

.containerbus {
  display: flex;
  justify-content: center;
}

.autobus {
  background: lightgray;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 200px;
  height: auto;
}

.fila {
  display: flex;
  justify-content: space-between;
}

.seccion {
  display: flex;
  width: 40%;
  justify-content: space-between;
}

.asiento {
  width: 21px;
  height: auto;
  color: white;
  font-size: 10;
  text-align: center;
  background: #fcfff4;
  background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
  margin: 5px auto;
  box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
  position: relative;
}

.asiento label {
  cursor: pointer;
  position: absolute;
  width: 15px;
  height: auto;
  left: 3px;
  top: 3px;
  box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.5), 0px 1px 0px rgba(255, 255, 255, 1);
  background: linear-gradient(top, #222 0%, #45484d 100%);
}

.asiento label:after {
  filter: alpha(opacity=0);
  opacity: 0;
  content: '';
  position: absolute;
  width: 15px;
  height: auto;
  background: #00bf00;
  background: linear-gradient(top, #0895d3 0%, #0966a8 100%);
  top: 0px;
  left: 0px;
  box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
}

.asiento label:hover::after {
  filter: alpha(opacity=30);
  opacity: 0.3;
}

.asiento input[type=checkbox]:checked + label:after {
  filter: alpha(opacity=100);
  opacity: 1;
}</style>
<section class="content">
    <div class="row">
 
        <div class="col-md-4">
<div class="containerbus">
  <!-- Squared ONE -->
  <div class="autobus">
<div align="center">FRONT</div>
<div style="margin-left:10%;"><b>LOWER</b></div>
<img src ="<?php echo profile_photo_url('/invitation/drv.png'); ?>"  width="20" height="20" style="margin-left:80%;">
---------------------------------------------
<div class="fila">
      <div class="seccion">
        <div class="asiento">
       <ul class="thumbnails"> <li class='span1'><a href='#' class='thumbnail' title='Available'></a></li></ul>
          <input type="checkbox" value="None" id="asiento1" name="check" />
          <label for="asiento1">1</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento3" name="check" />
          <label for="asiento3">3</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento4" name="check" />
          <label for="asiento4">4</label>
        </div>
      </div>
    </div>

    <div class="fila">
      <div class="seccion">
        <div class="asiento">
        <ul class="thumbnails"> <li class='span1'><a href='#' class='thumbnail' title='Available'></a></li></ul>
          <input type="checkbox" value="None" id="asiento5" name="check" />
          <label for="asiento5">5</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento7" name="check" />
          <label for="asiento7">7</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento8" name="check" />
          <label for="asiento8">8</label>
        </div>
      </div>
    </div>

    <div class="fila">
      <div class="seccion">
        <div class="asiento">
        <ul class="thumbnails"> <li class='span1'><a href='#' class='thumbnail' title='Available'></a></li></ul>
          <input type="checkbox" value="None" id="asiento9" name="check" />
          <label for="asiento9">9</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento11" name="check" />
          <label for="asiento11">11</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento12" name="check" />
          <label for="asiento12">12</label>
        </div>
      </div>
    </div>

    <div class="fila">
      <div class="seccion">
        <div class="asiento">
        <ul class="thumbnails"> <li class='span1'><a href='#' class='thumbnail' title='Available'></a></li></ul>
          <input type="checkbox" value="None" id="asiento13" name="check" />
          <label for="asiento13">13</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento15" name="check" />
          <label for="asiento15">15</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento16" name="check" />
          <label for="asiento16">16</label>
        </div>
      </div>
    </div>

    <div class="fila">
      <div class="seccion">
        <div class="asiento">
        <ul class="thumbnails"> <li class='span1'><a href='#' class='thumbnail' title='Available'></a></li></ul>
          <input type="checkbox" value="None" id="asiento17" name="check" />
          <label for="asiento17">17</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento19" name="check" />
          <label for="asiento19">19</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento20" name="check" />
          <label for="asiento20">20</label>
        </div>
      </div>
    </div>

	<div align="center">REAR</div>
  </div>
</div>

</div>
<div class="col-md-4">
<div class="containerbus">
  <!-- Squared ONE -->
  <div class="autobus">
<div align="center">FRONT</div>
<div style="margin-left:10%;"><b>UPPER</b></div>
&nbsp;
---------------------------------------------
<div class="fila">
      <div class="seccion">
        <div class="asiento">
       <ul class="thumbnails"> <li class='span1'><a href='#' class='thumbnail' title='Available'></a></li></ul>
          <input type="checkbox" value="None" id="asiento1" name="check" />
          <label for="asiento1">1</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento3" name="check" />
          <label for="asiento3">3</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento4" name="check" />
          <label for="asiento4">4</label>
        </div>
      </div>
    </div>

    <div class="fila">
      <div class="seccion">
        <div class="asiento">
        <ul class="thumbnails"> <li class='span1'><a href='#' class='thumbnail' title='Available'></a></li></ul>
          <input type="checkbox" value="None" id="asiento5" name="check" />
          <label for="asiento5">5</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento7" name="check" />
          <label for="asiento7">7</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento8" name="check" />
          <label for="asiento8">8</label>
        </div>
      </div>
    </div>

    <div class="fila">
      <div class="seccion">
        <div class="asiento">
        <ul class="thumbnails"> <li class='span1'><a href='#' class='thumbnail' title='Available'></a></li></ul>
          <input type="checkbox" value="None" id="asiento9" name="check" />
          <label for="asiento9">9</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento11" name="check" />
          <label for="asiento11">11</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento12" name="check" />
          <label for="asiento12">12</label>
        </div>
      </div>
    </div>

    <div class="fila">
      <div class="seccion">
        <div class="asiento">
        <ul class="thumbnails"> <li class='span1'><a href='#' class='thumbnail' title='Available'></a></li></ul>
          <input type="checkbox" value="None" id="asiento13" name="check" />
          <label for="asiento13">13</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento15" name="check" />
          <label for="asiento15">15</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento16" name="check" />
          <label for="asiento16">16</label>
        </div>
      </div>
    </div>

    <div class="fila">
      <div class="seccion">
        <div class="asiento">
        <ul class="thumbnails"> <li class='span1'><a href='#' class='thumbnail' title='Available'></a></li></ul>
          <input type="checkbox" value="None" id="asiento17" name="check" />
          <label for="asiento17">17</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento19" name="check" />
          <label for="asiento19">19</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento20" name="check" />
          <label for="asiento20">20</label>
        </div>
      </div>
    </div>

	<div align="center">REAR</div>
  </div>
</div>

</div>

</div>
</section>

 
 