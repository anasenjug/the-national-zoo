<?php 
include "head.php";
?>
<div class="footer">
        <div class="donations">
            <div class="donations__text">
            Want to support us? 
            </div>
            <form class="donations__form">
              <span class="donations__input-icon">$</span>
              <input class="donations__input" type="number" value="50" title="$"/>
              <input type="submit" class="donations__submit" value="Donate">
            </form>
          </div>
    </div>


    <script>
      var $form = $(".donations__form");
      var $input = $(".donations__input");
      var $submit = $(".donations__submit");
      var $progress = $(".donations__amount");
      var $donors = $(".donations__donors");
      var $progressBar = $(".donations__progress-bar");
    
      $form.on("submit", function(e) {
        e.preventDefault();

        var donation = parseInt($input.val());
    
        $.ajax({
          url: "save_donation.php", 
          method: "POST",
          data: { amount: donation },
          success: function(response) {
            alert("Thank you for donating!");
            console.log("Donation saved:", response);

            $progress.text(response.totalDonation.toLocaleString());
            $donors.text(response.totalDonors);
  
            $input.val(0);
          },
          error: function(xhr, status, error) {
            console.error("Error saving donation:", error);
          }
        });
      });
  
    </script> 