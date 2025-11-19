@extends('front.layouts.app')
@section('style')

    @endsection
@section('content')

    <div class="container position-relative">
        <!-- Products Area -->
        <div class="row">

            <div class="col-12 col-md-3 ml-2 right-side" id="sidebar">
                <aside class="sidebarFilters" aria-label="فیلترها">
                    <div class="f-group">
                        <div class="f-title">فیلترها</div>
                    </div>

                    <div class="f-group">
                        <div class="f-label">جستجوی پارامتریک</div>
                        <input id="paramSearch" placeholder="مثال: 1k, SMD, 0805, 10µF" style="width:100%;padding:8px;border-radius:8px;border:1px solid #eef2f7">
                    </div>

                    <div class="f-group">
                        <div class="f-label">دسته‌بندی</div>
                        <div class="checkbox-list" id="categoryList" aria-label="دسته‌بندی">
                            <label><span>Capacitor</span><input type="checkbox" value="Capacitor" id="cat_Capacitor"><span class="tiny count"> (2)</span></label>
                            <label><span>Connector</span><input type="checkbox" value="Connector" id="cat_Connector"><span class="tiny count"> (1)</span></label>
                            <label><span>Diode</span><input type="checkbox" value="Diode" id="cat_Diode"><span class="tiny count"> (1)</span></label>
                            <label><span>IC</span><input type="checkbox" value="IC" id="cat_IC"><span class="tiny count"> (1)</span></label>
                            <label><span>IGBT</span><input type="checkbox" value="IGBT" id="cat_IGBT"><span class="tiny count"> (1)</span></label>
                            <label><span>LED</span><input type="checkbox" value="LED" id="cat_LED"><span class="tiny count"> (1)</span></label>
                            <label><span>MCU</span><input type="checkbox" value="MCU" id="cat_MCU"><span class="tiny count"> (1)</span></label>
                            <label><span>Resistor</span><input type="checkbox" value="Resistor" id="cat_Resistor"><span class="tiny count"> (2)</span></label>
                            <label><span>Sensor</span><input type="checkbox" value="Sensor" id="cat_Sensor"><span class="tiny count"> (1)</span></label>
                            <label><span>Transistor</span><input type="checkbox" value="Transistor" id="cat_Transistor"><span class="tiny count"> (1)</span></label>
                        </div>
                    </div>

                    <div class="f-group">
                        <div class="f-label">سازنده</div>
                        <div id="manufacturerList">
                            <button class="chip active" type="button" data-manufacturer="Comchip">Comchip (1)</button>
                            <button class="chip" type="button" data-manufacturer="Infineon">Infineon (1)</button>
                            <button class="chip" type="button" data-manufacturer="Mitsubishi">Mitsubishi (1)</button>
                            <button class="chip" type="button" data-manufacturer="Murata">Murata (1)</button>
                            <button class="chip" type="button" data-manufacturer="OSRAM">OSRAM (1)</button>
                            <button class="chip" type="button" data-manufacturer="Panasonic">Panasonic (1)</button>
                            <button class="chip" type="button" data-manufacturer="Samtec">Samtec (1)</button>
                            <button class="chip" type="button" data-manufacturer="Sensirion">Sensirion (1)</button>
                            <button class="chip" type="button" data-manufacturer="STMicro">STMicro (1)</button>
                            <button class="chip" type="button" data-manufacturer="Texas Instruments">Texas Instruments (1)</button>
                            <button class="chip" type="button" data-manufacturer="Vishay">Vishay (1)</button>
                            <button class="chip" type="button" data-manufacturer="Yageo">Yageo (1)</button>
                        </div>
                    </div>

                    <div class="f-group">
                        <div class="f-label">پکیج / بسته‌بندی</div>
                        <div id="packageList">
                            <button class="chip" type="button" data-package="0603">0603 (1)</button>
                            <button class="chip" type="button" data-package="0805">0805 (2)</button>
                            <button class="chip" type="button" data-package="1206">1206 (1)</button>
                            <button class="chip active" type="button" data-package="2x20">2x20 (1)</button>
                            <button class="chip" type="button" data-package="DFN-8">DFN-8 (1)</button>
                            <button class="chip" type="button" data-package="LQFP-48">LQFP-48 (1)</button>
                            <button class="chip" type="button" data-package="Module">Module (1)</button>
                            <button class="chip" type="button" data-package="Radial">Radial (1)</button>
                            <button class="chip" type="button" data-package="SMA">SMA (1)</button>
                            <button class="chip" type="button" data-package="SOT-223">SOT-223 (1)</button>
                            <button class="chip" type="button" data-package="TO-220">TO-220 (1)</button>
                        </div>
                    </div>

                    <div class="f-group">
                        <div class="f-label">بسته‌بندی SMD / Through-hole</div>
                        <div style="display:flex;gap:8px">
                            <button class="chip active" data-key="mount" data-val="any">همه</button>
                            <button class="chip" data-key="mount" data-val="SMD">SMD</button>
                            <button class="chip" data-key="mount" data-val="Through-Hole">Through-Hole</button>
                        </div>
                    </div>

                    <div class="f-group">
                        <div class="f-label">قیمت (تومان)</div>
                        <div class="range-row" style="margin-top:8px">
                            <input id="minPrice" type="number" placeholder="کمترین">
                            <input id="maxPrice" type="number" placeholder="98,000">
                        </div>
                    </div>

                    <div class="f-group">
                        <div class="f-label">مشخصات فنی (نمونه — مقاومت / خازن / ولتاژ)</div>
                        <div style="display:flex;flex-direction:column;gap:8px">
                            <div style="display:flex;gap:8px;flex-direction: column;">
                                <input id="specA_min" type="number" placeholder="A min" style="flex:1;padding:8px;border-radius:6px;border:1px solid #eef2f7">
                                <input id="specA_max" type="number" placeholder="A max" style="flex:1;padding:8px;border-radius:6px;border:1px solid #eef2f7">
                            </div>
                            <div style="display:flex;gap:8px;flex-direction: column;">
                                <input id="specB_min" type="number" placeholder="B min" style="flex:1;padding:8px;border-radius:6px;border:1px solid #eef2f7">
                                <input id="specB_max" type="number" placeholder="B max" style="flex:1;padding:8px;border-radius:6px;border:1px solid #eef2f7">
                            </div>
                            <div style="display:flex;gap:8px">
                                <label style="display:flex;gap:8px;align-items:center"><input id="rohs" type="checkbox"> RoHS</label>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;gap:8px;margin-top:10px">
                        <button id="resetBtn" class="btn ghost">بازنشانی</button>
                        <button id="applyBtn" class="btn">اعمال فیلتر</button>
                    </div>


                </aside>

            </div>

            <!-- end filter bar -->
            <div class="col-12 col-md-9 px-0 left-side" style="margin-top: 19px;">
                <section class="container products-area px-0">
                    <div class="row m-auto">
                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-price="578000" data-brand="bosch" data-color="black">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-WI01.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>کنترلر و نمایشگر وزن PM-WI01-DIS</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">570,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="1540000" data-color="white">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-CT11.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر وزن دو کانال PM-LT12A با خروجی آنالوگ</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="540000" data-color="black">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-RD01-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>نمایشگر ثانویه</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="540000" data-color="green">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-RL04.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>برد رله 4 کانال</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sisi" data-color="white" data-price="1208000">
                            <div class="pro">
              <span class="badge badge-star">
                <p class="">3.4</p>
                <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                </svg>
              </span>
                                <div class="top">
                                    <img src="design/image/PM-US02-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>مبدل USB به RS485 غیر ایزوله</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">1,208,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sony" data-price="1508000" data-color="black">
                            <div class="pro">
              <span class="badge badge-star">
                <p class="">3.4</p>
                <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                </svg>
              </span>
                                <div class="top">
                                    <img src="design/image/PM-RIO16L.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ماژول ریموت IO</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="1000000" data-color="white">
                            <div class="pro">
                  <span class="badge badge-star">
                    <p class="">3.4</p>
                    <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                  </span>
                                <div class="top">
                                    <img src="design/image/PM-CT11.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر وزن دو کانال PM-LT12A با خروجی آنالوگ</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sony" data-price="780000" data-color="white">
                            <div class="pro">
                  <span class="badge badge-star">
                    <p class="">3.4</p>
                    <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                  </span>
                                <div class="top">
                                    <img src="design/image/PM-RD01-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>نمایشگر ثانویه</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="540000" data-color="black">
                            <div class="pro">
                  <span class="badge badge-star">
                    <p class="">3.4</p>
                    <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                  </span>
                                <div class="top">
                                    <img src="design/image/PM-RL04.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>برد رله 4 کانال</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sony" data-price="1208000" data-color="black">
                            <div class="pro">
                  <span class="badge badge-star">
                    <p class="">3.4</p>
                    <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                  </span>
                                <div class="top">
                                    <img src="design/image/PM-US02-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>مبدل USB به RS485 غیر ایزوله</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sony" data-price="1508000" data-color="silver">
                            <div class="pro">
                  <span class="badge badge-star">
                    <p class="">3.4</p>
                    <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                  </span>
                                <div class="top">
                                    <img src="design/image/PM-RIO16L.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ماژول ریموت IO</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="1000000" data-color="white">
                            <div class="pro">
                <span class="badge badge-star">
                  <p class="">3.4</p>
                  <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                  </svg>
                </span>
                                <div class="top">
                                    <img src="design/image/PM-CT11.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر وزن دو کانال PM-LT12A با خروجی آنالوگ</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="780000" data-color="silver">
                            <div class="pro">
                <span class="badge badge-star">
                  <p class="">3.4</p>
                  <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                  </svg>
                </span>
                                <div class="top">
                                    <img src="design/image/PM-RD01-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>نمایشگر ثانویه</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sony" data-price="540000" data-color="white">
                            <div class="pro">
                <span class="badge badge-star">
                  <p class="">3.4</p>
                  <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                  </svg>
                </span>
                                <div class="top">
                                    <img src="design/image/PM-RL04.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>برد رله 4 کانال</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="chichi" data-price="1208000" data-color="black">
                            <div class="pro">
                <span class="badge badge-star">
                  <p class="">3.4</p>
                  <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                  </svg>
                </span>
                                <div class="top">
                                    <img src="design/image/PM-US02-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>مبدل USB به RS485 غیر ایزوله</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sony" data-price="1508000" data-color="silver">
                            <div class="pro">
                <span class="badge badge-star">
                  <p class="">3.4</p>
                  <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                  </svg>
                </span>
                                <div class="top">
                                    <img src="design/image/PM-RIO16L.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ماژول ریموت IO</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="1000000" data-color="black">
                            <div class="pro">
              <span class="badge badge-star">
                <p class="">3.4</p>
                <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                </svg>
              </span>
                                <div class="top">
                                    <img src="design/image/PM-CT11.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر وزن دو کانال PM-LT12A با خروجی آنالوگ</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="chichi" data-price="780000" data-color="black">
                            <div class="pro">
                        <span class="badge badge-star">
                          <p class="">3.4</p>
                          <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                          </svg>
                        </span>
                                <div class="top">
                                    <img src="design/image/PM-RD01-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>نمایشگر ثانویه</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sony" data-price="540000" data-color="silver">
                            <div class="pro">
                      <span class="badge badge-star">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-RL04.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>برد رله 4 کانال</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sisi" data-price="1208000" data-color="white">
                            <div class="pro">
                      <span class="badge badge-star">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-US02-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>مبدل USB به RS485 غیر ایزوله</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="1508000" data-color="silver">
                            <div class="pro">
                      <span class="badge badge-star">
                        <p class="">3.4</p>
                        <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                        </svg>
                      </span>
                                <div class="top">
                                    <img src="design/image/PM-RIO16L.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ماژول ریموت IO</span>
                                </div>
                                <div class="down">
                                    <div class="final-price mb-2">1508,000 تومان</div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="1200000" data-color="black">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-CT11.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر وزن دو کانال PM-LT12A با خروجی آنالوگ</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sony" data-price="1750000" data-color="silver">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-RD01-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>نمایشگر ثانویه</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="1240000" data-color="silver">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-WI01.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>کنترلر و نمایشگر وزن PM-WI01-DIS</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sisi" data-color="white" data-price="540000">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-RL04.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>برد رله 4 کانال</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sisi" data-price="1208000" data-color="black">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-US02-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>مبدل USB به RS485 غیر ایزوله</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="1508000" data-color="silver">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-RIO16L.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ماژول ریموت IO</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="chichi" data-price="1000000" data-color="white">
                            <div class="pro">
                  <span class="badge badge-star">
                    <p class="">3.4</p>
                    <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                  </span>
                                <div class="top">
                                    <img src="design/image/PM-CT11.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر وزن دو کانال PM-LT12A با خروجی آنالوگ</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="780000" data-color="black">
                            <div class="pro">
                  <span class="badge badge-star">
                    <p class="">3.4</p>
                    <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                  </span>
                                <div class="top">
                                    <img src="design/image/PM-RD01-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>نمایشگر ثانویه</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="540000" data-color="white">
                            <div class="pro">
                  <span class="badge badge-star">
                    <p class="">3.4</p>
                    <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                  </span>
                                <div class="top">
                                    <img src="design/image/PM-RL04.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>برد رله 4 کانال</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sisi" data-price="578000" data-color="silver">
                            <div class="pro">
                  <span class="badge badge-star">
                    <p class="">3.4</p>
                    <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                  </span>
                                <div class="top">
                                    <img src="design/image/PM-US02-1.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>مبدل USB به RS485 غیر ایزوله</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="bosch" data-price="1508000" data-color="silver">
                            <div class="pro">
                  <span class="badge badge-star">
                    <p class="">3.4</p>
                    <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                  </span>
                                <div class="top">
                                    <img src="design/image/PM-RIO16L.jpg" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ماژول ریموت IO</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="chichi" data-price="850000" data-color="white">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="sisi" data-color="black" data-price="940000">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 p-0 ml-1 product-card" data-brand="chichi" data-price="350000" data-color="black">
                            <div class="pro">
                    <span class="badge badge-star">
                      <p class="">3.4</p>
                      <svg width="16" height="16" fill="#161313" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                      </svg>
                    </span>
                                <div class="top">
                                    <img src="design/image/PM-AD40.png" alt="PM-AD40">
                                </div>
                                <div class="product-name">
                                    <span>ترانسمیتر آنالوگ ورودی 4 کانال PM-AD40</span>
                                </div>
                                <div class="down">
                                    <div class="final-price-div mb-2">
                                        <div class="mx-1">540,000</div>
                                        <div>تومان</div>
                                    </div>
                                    <div class="box">
                                        <div class="text-danger">
                                            <span class="Quantity-stock">تنها 5 عدد در انبار باقی مانده</span>
                                        </div>
                                        <button class="addtocart">
                                            خرید
                                        </button>
                                    </div>
                                </div>
                                <!-- ⚠ Overlay  -->
                                <div class="product-overlay">
                                    <button class="btn btn-danger">جزئیات بیشتر</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
