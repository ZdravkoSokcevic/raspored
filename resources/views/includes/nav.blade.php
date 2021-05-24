<navbar>
  <script type="text/javascript">
    let refreshPage = () => {
      window.location.reload();
    }
  </script>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a
          role="button"
          class="list-group-item list-group-item-action py-2 ripple"
          aria-current="true"
          onclick="refreshPage()"
        >
          <i class="fas fa-redo fa-fw me-3"></i>&nbsp;<span>Refresh</span>
        </a>
        <a
          href="/settings"
          class="list-group-item list-group-item-action py-2 ripple <?php if(@$active == 'settings') echo 'active';?>"
          aria-current="true"
        >
    			<i class="fas fa-cog fa-fw me-3"></i>&nbsp;<span>Podesavanja</span>
        </a>
        <a 
        	href="/calendar" 
        	class="list-group-item list-group-item-action py-2 ripple <?php if(@$active == 'calendar') echo 'active';?>"
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