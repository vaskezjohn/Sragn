<?php if (isset($_SESSION["user_id"])):?>
<div class="container">
  <div class="row">
    <section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" id="paso1" class="<?php echo $this->estadop1;  ?>">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Linea">
                            <span class="round-tab" style="padding-top: 25%;">
                                <i class="glyphicon glyphicon-check"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" id="paso2" class="<?php echo $this->estadop2;  ?>">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Estacion y Turno">
                            <span class="round-tab" style="padding-top: 25%;">
                                <i class="glyphicon glyphicon-hand-up"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" id="paso3" class="<?php echo $this->estadop3;  ?>">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Enviar Solicitud">
                            <span class="round-tab" style="padding-top: 25%;">
                                <i class="glyphicon glyphicon-send"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" id="pasoFin" class="<?php echo $this->estadofin;  ?>">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Aprobado">
                            <span class="round-tab" style="padding-top: 25%;">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>       
                <div class="tab-content">
                    
                    <div class="tab-pane <?php echo  ($this->estadop1!='disabled' ? $this->estadop1 : '');  ?>" role="tabpanel" id="step1">
                        <h3>Seleccionar Linea de Tren</h3>
                        <form  role="form" method="post" action="?controller=variables&action=TraerEstaciones">
                        <div class="panel panel-default"> 
                          <div class="panel-body">
                          <div class="form-group">
                            <div class="row">
                                    <div class="funkyradio">
                                        <?php foreach($this->objLineas->ObtenerLineas() as $r):?>
                                          <div class="funkyradio-primary col-xs-12 col-sm-3 col-lg-3">
                                            <input type="radio" name="radio" id="<?php echo $r->idcodlinea;?>" value="<?php echo $r->idcodlinea;?>"/>
                                            <label for="<?php echo $r->idcodlinea;?>">Linea <?php echo $r->desclinea;?></label>
                                          </div>
                                        <?php endforeach;?>
                                    <!--    <div class="funkyradio-primary col-xs-12 col-sm-3 col-lg-3">
                                            <input type="radio" name="radio" id="radio1" value="gralRoca"/>
                                            <label for="radio1">Linea Gral Roca</label>
                                        </div>
                                        <div class="funkyradio-warning col-xs-12 col-sm-3 col-lg-3">
                                            <input type="radio" name="radio" id="radio2"/>
                                            <label for="radio2">Linea Mitre</label>
                                        </div>
                                        <div class="funkyradio-success col-xs-12 col-sm-3 col-lg-3">
                                            <input type="radio" name="radio" id="radio3" />
                                            <label for="radio3">Linea Belgrano</label>
                                        </div>
                                        <div class="funkyradio-danger col-xs-12 col-sm-3 col-lg-3">
                                            <input type="radio" name="radio" id="radio4" />
                                            <label for="radio4">Linea Sarmiento</label>
                                        </div>          !-->                        
                                    </div>  
                             </div>                                                           
                            </div>
                          </div>
                        </div>
                                     
   
                        <ul class="list-inline pull-right">
                            <li><button type="submit" class="btn btn-block btn-primary next-step">Siguiente</button></li>
                        </ul>
                        </form>
                    </div>
                     

                    
                    <div class="tab-pane <?php echo  ($this->estadop2!='disabled' ? $this->estadop2 : ''); ?>" role="tabpanel" id="step2">
                        <h3>Seleccionar Estacion y el Turno</h3>
                        <div id="txt-sem">
                        </div>

                        <form  role="form" method="post" action="?controller=variables&action=EnviarSolicitud">
                        <div class="panel panel-default"> 
                          <div class="panel-body">
                          <br>
    
                                <div class="form-group">
                                <div class="row">

                                <div class="col-xs-12 col-sm-4 col-lg-4 espacio">     
                                <div class="input-group">
                                        <span class="input-group-addon" >Estacion</span>
                                            <select class="form-control" name="estacion" id="stl-estacion">
                                                <?php foreach ($this->objEstaciones->ObtenerEstaciones($this->linea) as $row ):?>
                                                <option value="<?php  echo $row->idcodestacion; ?>"><?php echo $row->estacion;?></option>
                                                <?php endforeach;?>
                                            </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-4 col-lg-4 espacio">

                                    <div class="input-group">
                                        <span class="input-group-addon" id="dia">Dia</span>
                                            <select class="form-control" name="dia" id="stl-dia">
                                                <option 'selected'>Lunes</option>
                                                <option>Martes</option>
                                                <option>Mircoles</option>
                                                <option>Jueves</option>
                                                <option>Viernes</option>
                                                <option>Sabado</option>
                                                <option>Domingo</option>
                                            </select>
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-4 col-lg-4">        

                                    <div class="input-group">
                                        <span class="input-group-addon" id="turno">Turno</span>
                                        <select class="form-control selturno" name="turno" id="selTurno">
                                                <option 'selected'>Mañana</option>
                                                <option>Noche</option>
                                     </select>
                                    </div>
            
                                  
                                </div>
                              </div>
                              </div>    
                                                                                   

                          </div>
                        </div> 
                        <input type="hidden" name="linea" value="<?php echo $this->linea; ?>"> 
                                
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                            <li><button type="submit" class="btn btn-default next-step">Solicitar</button></li>
                        </ul>
                         </form>
                    </div>
                    
                    <div class="tab-pane <?php echo ($this->estadop3!='disabled' ? $this->estadop3 : '');  ?>" role="tabpanel" id="step3">
                        <h3>Step 3</h3>
                        <p>This is step 3</p>
                        <!--
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                            <li><button type="button" class="btn btn-primary btn-info-full">Guardar y Continuar</button></li>
                        </ul>
                        !-->
                    </div>
                    <div class="tab-pane <?php echo  ($this->estadofin!='disabled' ? $this->estadofin : ''); ?>" role="tabpanel" id="complete">
                        <h3>Se Aprobo el Turno</h3>
                        <p>El Planillero encargado del la estacion aprobo el turno solicitado</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
        </div>
    </section>
   </div>
</div>


<?php endif?>


