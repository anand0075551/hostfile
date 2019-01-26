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
  width: 400px;
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

<div class="containerbus">
  <!-- Squared ONE -->
  <div class="autobus">
<img src ="<?php echo profile_photo_url('/invitation/stage.png'); ?>"  width="auto" height="50%;">
------------------------------------------------------------------------------------------

   <?php
   $row_count = $num/10; 
   for($row=1;$row<=$row_count;$row++)  
      {?>

    <div class="fila">
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento34" name="check" />
          <label for="asiento21">34</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento35" name="check" />
          <label for="asiento22">35</label>
        </div>
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento36" name="check" />
          <label for="asiento23">36</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento39" name="check" />
          <label for="asiento23">39</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento40" name="check" />
          <label for="asiento23">40</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento41" name="check" />
          <label for="asiento24">41</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento42" name="check" />
          <label for="asiento23">42</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento43" name="check" />
          <label for="asiento24">43</label>
        </div>
        
      </div>
      <div class="seccion">
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento44" name="check" />
          <label for="asiento21">44</label>
        </div>
        <div class="asiento">
          <input type="checkbox" value="None" id="asiento45" name="check" />
          <label for="asiento22">45</label>
        </div>
      </div>
    </div>
    <?php }?>
    <div align="center">Exit</div>
  </div>
</div>
