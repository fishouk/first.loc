 <section class="row">
      <div class="col-xs-12">
      <?php 
        foreach ($this->error as $key => $value) {
          echo "<span class=\"alert alert-danger\" role=\"alert\"> $value </span>";
        }
      ?>
      </div>
    </section>