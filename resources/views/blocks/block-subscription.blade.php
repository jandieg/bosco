<!-- Block Works -->
<div class="row">
  <div class="block-suscription clearfix">
    <div class="block-suscription-item">
      <div class="block-suscription-background"></div>
      <div class="block-suscription-detail">
        <h3>Creemos algo grande juntos</h3>
        <h5>Únete a la solución y se parte del cambio.</h5>
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
          <form id="form-subscriptions" class="form-inline" action="{{ url('subscription') }}" method="POST">
            <div class="form-group">
              <input name="email" type="email" placeholder="Email" required class="form-control">
            </div>
            <div class="form-group form-actions">
              <input type="submit" class="btn btn-primary" value="Suscríbete">
            </div>
            {{ csrf_field() }}
          </form>
          <div id="subscription-message" style="display: none">

          </div>
        </div>
      </div>
      <img src="{{ url('img/bg-subscription.png') }}">
    </div>
  </div>
</div>