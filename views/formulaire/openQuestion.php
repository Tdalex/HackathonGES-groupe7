<div id="qcmview" class="full-height">
  <div class="full-height">
    <div class="col-md-3 full-height" style="margin-left: 0; text-align:center;">
      <img class="home-logo" src="/src/img/home-logo.png" height="250">
      <div style="text-align: center;">
        <span style="color: #434343; font-size: 25px; font-weight: 800; text-align: center; display: block; margin-bottom: 25px;">SCORE</span>
        <span style="padding: 20px 25px; font-size: 25px; font-weight: 800; background-color: #434343; color: white;">{{score}}</span>
      </div>
    </div>
    <div class="col-md-9 full-height">
      <div style="background: white; border: solid 1px grey; padding: 15px;position: relative; margin-bottom: 15px;">
        <span style="font-size: 20px; font-weight: 800;">{{job_name}}</span>
      </div>

      <div class="game-panel">

        <div class="game-panel-right" style="margin-right: 25px;">
          <div style="width: 350px; background: white;height: 100px;position: absolute;left: -359px;border-radius: 10px; padding: 10px; border: solid 3px #292929;">
            <span style="font-size: 18px; font-weight: 800;">Hackerman</span>
            <span style="display:block;">8/10</span>
            <span>
              <div style="width: 320px; height: 15px; background: grey; position: relative; border-radius: 10px;">
                <div style="position: absolute; background: green; width: 270px; height: 15px; border-radius: 10px;"></div>
              </div>
            </span>
          </div>
          <img src="/src/img/ennemi1.png" >
        </div>

        <div class="game-panel-left">
          <div style="width: 350px; background: white;height: 100px;position: absolute;right: -370px;border-radius: 10px; padding: 10px; border: solid 3px #292929; bottom: 35px;">
            <span style="font-size: 18px; font-weight: 800; display : inline-block;">
              <span style="display:block;">{{username}}<span>
              <span style="display:block;">4/10</span>
              <span>
                <div style="width: 320px; height: 15px; background: grey; position: relative; border-radius: 10px;">
                  <div style="position: absolute; background: red; width: 150px; height: 15px; border-radius: 10px;"></div>
                </div>
              </span>

            </span>
            <button class="btn gfi-btn gfi-btn-second home-btn full-width" style="position: absolute;right: -279px;bottom: 32px;border-radius: 20px;width: 250px;">
              <span class="gfi-btn-span firstspan">{{skill}}</span>
              <span class="gfi-btn-span secondspan">{{skill}}</span>
            </button>
          </div>
          <img src="/src/img/back1.png" height="250">
        </div>

        <!-- question -->

        <div class="game-panel-down" style="margin-bottom: 10px; text-align: center;">
          <div style="background: white; padding: 15px; margin-bottom: 15px;">{{wording}}</div>
          <div class='answer-field'>
			<input  id='answer' placeholder='Reponse' type='text'></input>
			<button type='button' data-type='open' class="btn gfi-btn gfi-btn-second home-btn no-border answer_question">
              <span class="gfi-btn-span firstspan">Valider</span>
              <span class="gfi-btn-span secondspan">Valider</span>
			</button>
          </div>
        </div>

        <!-- fin question -->

      </div>
    </div>

  </div>
</div>
