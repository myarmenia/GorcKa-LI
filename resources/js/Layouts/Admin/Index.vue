<template>
    <div class="h-screen flex flex-row flex-wrap">

    <!-- start sidebar -->
  <div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">


    <!-- sidebar content -->
    <div class="flex flex-col">

      <!-- sidebar toggle -->
      <div class="text-right hidden md:block mb-4">
        <button id="sideBarHideBtn">
          <i class="fad fa-times-circle"></i>
        </button>
      </div>
      <!-- end sidebar toggle -->

      <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">homes</p>

      <!-- link -->
      <a href="./index.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-chart-pie text-xs mr-2"></i>
        Analytics dashboard
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="./index-1.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-shopping-cart text-xs mr-2"></i>
        ecommerce dashboard
      </a>
      <!-- end link -->

      <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">apps</p>

      <!-- link -->
      <a href="./email.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-envelope-open-text text-xs mr-2"></i>
        email
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-comments text-xs mr-2"></i>
        chat
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-shield-check text-xs mr-2"></i>
        todo
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-calendar-edit text-xs mr-2"></i>
        calendar
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-file-invoice-dollar text-xs mr-2"></i>
        invoice
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-folder-open text-xs mr-2"></i>
        file manager
      </a>
      <!-- end link -->


      <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">UI Elements</p>

      <!-- link -->
      <a href="./typography.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-text text-xs mr-2"></i>
        typography
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="./alert.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-whistle text-xs mr-2"></i>
        alerts
      </a>
      <!-- end link -->


      <!-- link -->
      <a href="./buttons.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-cricket text-xs mr-2"></i>
        buttons
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-box-open text-xs mr-2"></i>
        Content
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-swatchbook text-xs mr-2"></i>
        colors
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-atom-alt text-xs mr-2"></i>
        icons
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-club text-xs mr-2"></i>
        card
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-cheese-swiss text-xs mr-2"></i>
        Widgets
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-computer-classic text-xs mr-2"></i>
        Components
      </a>
      <!-- end link -->



    </div>
    <!-- end sidebar content -->

  </div>
  <!-- end sidbar -->

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16">


    <!-- General Report -->
    <div class="grid grid-cols-4 gap-6 xl:grid-cols-1">


    <!-- card -->
    <div class="report-card">
        <div class="card">
            <div class="card-body flex flex-col">

                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <div class="h6 text-indigo-700 fad fa-shopping-cart"></div>
                    <span class="rounded-full text-white badge bg-teal-400 text-xs">
                        12%
                        <i class="fal fa-chevron-up ml-1"></i>
                    </span>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>items sales</p>
                </div>
                <!-- end bottom -->

            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    <!-- end card -->


    <!-- card -->
    <div class="report-card">
        <div class="card">
            <div class="card-body flex flex-col">

                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <div class="h6 text-red-700 fad fa-store"></div>
                    <span class="rounded-full text-white badge bg-red-400 text-xs">
                        6%
                        <i class="fal fa-chevron-down ml-1"></i>
                    </span>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>new orders</p>
                </div>
                <!-- end bottom -->

            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    <!-- end card -->


    <!-- card -->
    <div class="report-card">
        <div class="card">
            <div class="card-body flex flex-col">

                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <div class="h6 text-yellow-600 fad fa-sitemap"></div>
                    <span class="rounded-full text-white badge bg-teal-400 text-xs">
                        72%
                        <i class="fal fa-chevron-up ml-1"></i>
                    </span>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>total Products</p>
                </div>
                <!-- end bottom -->

            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    <!-- end card -->


    <!-- card -->
    <div class="report-card">
        <div class="card">
            <div class="card-body flex flex-col">

                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <div class="h6 text-green-700 fad fa-users"></div>
                    <span class="rounded-full text-white badge bg-teal-400 text-xs">
                        150%
                        <i class="fal fa-chevron-up ml-1"></i>
                    </span>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>new Visitor</p>
                </div>
                <!-- end bottom -->

            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    <!-- end card -->


</div>
    <!-- End General Report -->

   


    <!-- start numbers -->
    <div class="grid grid-cols-5 gap-6 xl:grid-cols-2">

    <!-- card -->
    <div class="card mt-6">
        <div class="card-body flex items-center">

            <div class="px-3 py-2 rounded bg-indigo-600 text-white mr-3">
                <i class="fad fa-wallet"></i>
            </div>

            <div class="flex flex-col">
                <h1 class="font-semibold"><span class="num-2"></span> Sales</h1>
                <p class="text-xs"><span class="num-2"></span> payments</p>
            </div>

        </div>
    </div>
    <!-- end card -->

    <!-- card -->
    <div class="card mt-6">
        <div class="card-body flex items-center">

            <div class="px-3 py-2 rounded bg-green-600 text-white mr-3">
                <i class="fad fa-shopping-cart"></i>
            </div>

            <div class="flex flex-col">
                <h1 class="font-semibold"><span class="num-2"></span> Orders</h1>
                <p class="text-xs"><span class="num-2"></span> items</p>
            </div>

        </div>
    </div>
    <!-- end card -->

    <!-- card -->
    <div class="card mt-6 xl:mt-1">
        <div class="card-body flex items-center">

            <div class="px-3 py-2 rounded bg-yellow-600 text-white mr-3">
                <i class="fad fa-blog"></i>
            </div>

            <div class="flex flex-col">
                <h1 class="font-semibold"><span class="num-2"></span> posts</h1>
                <p class="text-xs"><span class="num-2"></span> active</p>
            </div>

        </div>
    </div>
    <!-- end card -->

    <!-- card -->
    <div class="card mt-6 xl:mt-1">
        <div class="card-body flex items-center">

            <div class="px-3 py-2 rounded bg-red-600 text-white mr-3">
                <i class="fad fa-comments"></i>
            </div>

            <div class="flex flex-col">
                <h1 class="font-semibold"><span class="num-2"></span> comments</h1>
                <p class="text-xs"><span class="num-2"></span> approved</p>
            </div>

        </div>
    </div>
    <!-- end card -->

    <!-- card -->
    <div class="card mt-6 xl:mt-1 xl:col-span-2">
        <div class="card-body flex items-center">

            <div class="px-3 py-2 rounded bg-pink-600 text-white mr-3">
                <i class="fad fa-user"></i>
            </div>

            <div class="flex flex-col">
                <h1 class="font-semibold"><span class="num-2"></span> memebrs</h1>
                <p class="text-xs"><span class="num-2"></span> online</p>
            </div>

        </div>
    </div>
    <!-- end card -->

</div>
    <!-- end nmbers -->

    <!-- start quick Info -->
    <div class="grid grid-cols-3 gap-6 mt-6 xl:grid-cols-1">


    <!-- Browser Stats -->
    <div class="card">
        <div class="card-header">Browser Stats</div>

        <!-- brawser -->
        <div class="p-6 flex flex-row justify-between items-center text-gray-600 border-b">
            <div class="flex items-center">
                <i class="fab fa-chrome mr-4"></i>
                <h1>google chrome</h1>
            </div>
            <div>
                <span class="num-2"></span>%
            </div>
        </div>
        <!-- end brawser -->

        <!-- brawser -->
        <div class="p-6 flex flex-row justify-between items-center text-gray-600 border-b">
            <div class="flex items-center">
                <i class="fab fa-firefox mr-4"></i>
                <h1>firefox</h1>
            </div>
            <div>
                <span class="num-2"></span>%
            </div>
        </div>
        <!-- end brawser -->

        <!-- brawser -->
        <div class="p-6 flex flex-row justify-between items-center text-gray-600 border-b">
            <div class="flex items-center">
                <i class="fab fa-internet-explorer mr-4"></i>
                <h1>internet explorer</h1>
            </div>
            <div>
                <span class="num-2"></span>%
            </div>
        </div>
        <!-- end brawser -->

        <!-- brawser -->
        <div class="p-6 flex flex-row justify-between items-center text-gray-600 border-b-0">
            <div class="flex items-center">
                <i class="fab fa-safari mr-4"></i>
                <h1>safari</h1>
            </div>
            <div>
                <span class="num-2"></span>%
            </div>
        </div>
        <!-- end brawser -->

    </div>
    <!-- end Browser Stats -->

    <!-- Start Recent Sales -->
    <div class="card col-span-2 xl:col-span-1">
        <div class="card-header">Recent Sales</div>

        <table class="table-auto w-full text-left">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-r"></th>
                    <th class="px-4 py-2 border-r">product</th>
                    <th class="px-4 py-2 border-r">price</th>
                    <th class="px-4 py-2">date</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">

                <tr>
                    <td class="border border-l-0 px-4 py-2 text-center text-green-500"><i class="fad fa-circle"></i></td>
                    <td class="border border-l-0 px-4 py-2">Lightning to USB-C Adapter Lightning.</td>
                    <td class="border border-l-0 px-4 py-2">$<span class="num-2"></span></td>
                    <td class="border border-l-0 border-r-0 px-4 py-2"><span class="num-2"></span> minutes ago</td>
                </tr>
                <tr>
                    <td class="border border-l-0 px-4 py-2 text-center text-yellow-500"><i class="fad fa-circle"></i></td>
                    <td class="border border-l-0 px-4 py-2">Apple iPhone 8.</td>
                    <td class="border border-l-0 px-4 py-2">$<span class="num-2"></span></td>
                    <td class="border border-l-0 border-r-0 px-4 py-2"><span class="num-2"></span> minutes ago</td>
                </tr>
                <tr>
                    <td class="border border-l-0 px-4 py-2 text-center text-green-500"><i class="fad fa-circle"></i></td>
                    <td class="border border-l-0 px-4 py-2">Apple MacBook Pro.</td>
                    <td class="border border-l-0 px-4 py-2">$<span class="num-2"></span></td>
                    <td class="border border-l-0 border-r-0 px-4 py-2"><span class="num-2"></span> minutes ago</td>
                </tr>
                <tr>
                    <td class="border border-l-0 px-4 py-2 text-center text-red-500"><i class="fad fa-circle"></i></td>
                    <td class="border border-l-0 px-4 py-2">Samsung Galaxy S9.</td>
                    <td class="border border-l-0 px-4 py-2">$<span class="num-2"></span></td>
                    <td class="border border-l-0 border-r-0 px-4 py-2"><span class="num-2"></span> minutes ago</td>
                </tr>
                <tr>
                    <td class="border border-l-0 px-4 py-2 text-center text-yellow-500"><i class="fad fa-circle"></i></td>
                    <td class="border border-l-0 px-4 py-2">Samsung Galaxy S8 256GB.</td>
                    <td class="border border-l-0 px-4 py-2">$<span class="num-2"></span></td>
                    <td class="border border-l-0 border-r-0 px-4 py-2"><span class="num-2"></span> minutes ago</td>
                </tr>
                <tr>
                    <td class="border border-l-0 border-b-0 px-4 py-2 text-center text-green-500"><i class="fad fa-circle"></i></td>
                    <td class="border border-l-0 border-b-0 px-4 py-2">apple watch.</td>
                    <td class="border border-l-0 border-b-0 px-4 py-2">$<span class="num-2"></span></td>
                    <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2"><span class="num-2"></span> minutes ago</td>
                </tr>

            </tbody>
        </table>
    </div>
    <!-- End Recent Sales -->


</div>
    <!-- end quick Info -->


  </div>
  <!-- end content -->

</div>
</template>
