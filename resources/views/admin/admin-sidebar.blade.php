<div class="flex flex-col h-screen w-64 bg-gray-900 text-gray-100 fixed">
  <!-- Sidebar content, for example: -->
  <div class="flex items-center justify-center h-16 border-b border-gray-800">
    <span class="text-2xl font-semibold">Admin Panel</span>
  </div>
  <nav class="flex-1 overflow-y-auto">
    <ul class="p-2">
      <li class="my-2">
        <a class="flex items-center px-4 py-2 rounded hover:bg-gray-800">
          <i class="fa fa-tachometer" aria-hidden="true"></i>
          <span class="ml-3">Dashboard</span>
        </a>
      </li>
      <!-- More navigation links... -->
    </ul>
  </nav>
  <div class="p-4 border-t border-gray-800">
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="flex items-center px-4 py-2 rounded hover:bg-gray-800">
      <i class="fa fa-sign-out" aria-hidden="true"></i>
      <span class="ml-3">Logout</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
      @csrf
    </form>
  </div>
</div>
