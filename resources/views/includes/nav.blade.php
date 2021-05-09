<navbar>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a
          href="#"
          class="list-group-item list-group-item-action py-2 ripple <?php if(@$active == 'settings') echo 'active';?>"
          aria-current="true"
        >
			<i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Podesavanja</span>
        </a>
        <a 
        	href="#" 
        	class="list-group-item list-group-item-action py-2 ripple <?php if(@$active == 'overview') echo 'active';?>"
        >
          	<i class="fas fa-chart-area fa-fw me-3"></i><span>Pregled</span>
        </a>
        <a 	
        	href="#" 
        	class="list-group-item list-group-item-action py-2 ripple <?php if(@$active == 'monthly') echo 'active';?>"
          >
          	<i class="fas fa-lock fa-fw me-3"></i><span>Mjesecno</span></a
        >
      </div>
    </div>
  </nav>

</navbar>