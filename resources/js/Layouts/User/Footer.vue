<script setup>
import { useTrans } from '/resources/js/trans';

</script>

<template>
         <footer class="footer ">
            <!-- start footer -->
            <section class="py-8 bg-zinc-800 dark:bg-neutral-900">
                <div class="container mx-auto">
                    <div class="grid grid-cols-12 gap-4 text-white p-6">
                         <div class="col-span-12 md:col-span-6 block-left">
                            <!-- <div class="flex w-full md:justify-start  "> -->
                                <h4 class="text-white text-[23px]">Gorc-Ka</h4>
                            <!-- </div> -->
                        </div>

                        <div class=" col-span-12 md:col-span-6 block-right">
                            <ul class="flex gap-3 justify-end">
                                <li class="w-8 h-8 leading-loose text-center text-gray-200 transition-all duration-300 border rounded-full cursor-pointer border-gray-200/50 hover:text-gray-50 group-data-[theme-color=violet]:hover:bg-violet-500 group-data-[theme-color=sky]:hover:bg-sky-500 group-data-[theme-color=red]:hover:bg-red-500 group-data-[theme-color=green]:hover:bg-green-500 group-data-[theme-color=pink]:hover:bg-pink-500 group-data-[theme-color=blue]:hover:bg-blue-500 hover:border-transparent">
                                    <a href="https://www.facebook.com/share/1DwZ2mL7HQ/?mibextid=LQQJ4d" target="f">
                                        <i class="uil uil-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="w-8 h-8 leading-loose text-center text-gray-200 transition-all duration-300 border rounded-full cursor-pointer border-gray-200/50 hover:text-gray-50 group-data-[theme-color=violet]:hover:bg-violet-500 group-data-[theme-color=sky]:hover:bg-sky-500 group-data-[theme-color=red]:hover:bg-red-500 group-data-[theme-color=green]:hover:bg-green-500 group-data-[theme-color=pink]:hover:bg-pink-500 group-data-[theme-color=blue]:hover:bg-blue-500 hover:border-transparent">
                                    <a href="https://wa.me/796077707907" class="social-link" target="w">
                                        <i class="uil uil-whatsapp"></i>
                                    </a>
                                </li>
                                <li class="w-8 h-8 leading-loose text-center text-gray-200 transition-all duration-300 border rounded-full cursor-pointer border-gray-200/50 hover:text-gray-50 group-data-[theme-color=violet]:hover:bg-violet-500 group-data-[theme-color=sky]:hover:bg-sky-500 group-data-[theme-color=red]:hover:bg-red-500 group-data-[theme-color=green]:hover:bg-green-500 group-data-[theme-color=pink]:hover:bg-pink-500 group-data-[theme-color=blue]:hover:bg-blue-500 hover:border-transparent">
                                    <a href="https://www.instagram.com/gorc_ka.am?igsh=dnRqZDVta3ZqZHln&utm_source=qr" target="i" class="social-link">
                                        <i class="uil uil-instagram"></i>
                                    </a>
                                </li>
                                <li class="w-8 h-8 leading-loose text-center text-gray-200 transition-all duration-300 border rounded-full cursor-pointer border-gray-200/50 hover:text-gray-50 group-data-[theme-color=violet]:hover:bg-violet-500 group-data-[theme-color=sky]:hover:bg-sky-500 group-data-[theme-color=red]:hover:bg-red-500 group-data-[theme-color=green]:hover:bg-green-500 group-data-[theme-color=pink]:hover:bg-pink-500 group-data-[theme-color=blue]:hover:bg-blue-500 hover:border-transparent">
                                    <a href="https://t.me/webextechno" target="t" class="social-link">
                                        <i class="uil uil-telegram"></i>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>



                </div>
            </section>
            <!-- end footer -->
            <!-- strat footer alt -->
            <section class="py-6 border-t bg-zinc-800 border-gray-100/10 dark:bg-neutral-900">
                <div class="container mx-auto">
                    <div class="text-center">
                        <p class="mb-0 text-center text-white/50">
                            <!-- <script>document.write(new Date().getFullYear())</script> -->
                            © {{ new Date().getFullYear() }} Gorc-Ka -  {{useTrans('navbar.footer')}}
                            <a href="https://themeforest.net/search/themesdesign" target="_blank" class="underline transition-all duration-300 hover:text-gray-50">Webex Technologies LLC</a>
                        </p>
                    </div>
                </div>
            </section>
            <!-- end footer alt -->
        </footer>
</template>


<style scoped>
.block-left {
  text-align: center;
  display: flex;
  justify-content: center;
}
.block-right {
  text-align: center;
  display: flex;
  justify-content: center;
}

@media (min-width: 768px) {
  .block-left {
    justify-content: flex-start;
    text-align: left;
  }
  .block-right {
    justify-content: flex-end;
    text-align: right;
  }
}
</style>
