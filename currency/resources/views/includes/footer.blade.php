</div>
                 </div>
               </div>

</div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
 <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-end text-sm-start d-sm-inline-block">Copyright © oot.com 2022</span>
             </div>
          </footer>


            <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- stripe scripts -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('pk_test_51ISiPlBG8tWZQZa41rtzdEzETsB8MeueME4mswlWeiImKq3lXmYnbhp0FmlGIbvqR1E81uLROboD77nmyBBhxNKD005jenNqRR');
        const btn = document.getElementById("checkout-button")
        btn.addEventListener('click', function(e){
            e.preventDefault();
            stripe.redirectToCheckout({
                sessionId:  "<?php  echo $session->id  ?>"
            })
        });
    </script>
    <!-- stripe scripts -->

    <!-- plugins:js -->
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <!-- End custom js for this page -->
  </body>
</html> 