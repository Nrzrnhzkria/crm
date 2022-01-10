@extends('layouts.email')

@section('content')
  <table style="border: none; cellpadding: 0; cellspacing: 0;" class="body">
    <tr>
      <td>&nbsp;</td>
      <td class="container">
        <div class="content">
          <table class="main">

            <!-- START MAIN CONTENT AREA -->
            <tr>
              <td class="wrapper">
                <table style="border: none; cellpadding: 0; cellspacing: 0;" class="btn btn-primary">
                  <tr>
                      <td>
                          <p><h3>Hai {{ $name }}!</h3>
                          Terima kasih kerana ingin menyertai program {{$product_name}}.<br></p>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <p><b>Maklumat program adalah seperti berikut:-</b></p>
                          Pakej : {{$package_name}}<br>
                          Tarikh : {{  date('d/m/Y', strtotime($date_from))  }} - {{  date('d/m/Y', strtotime($date_to))  }}<br>
                          Masa : {{  date('h:i a', strtotime($time_from))  }} - {{  date('h:i a', strtotime($time_to))  }}<br></p>
                      </td>
                  </tr>
                  <tr>
                    <td class="align-center">
                      <table style="width: 100%; border: none; cellpadding: 0; cellspacing: 0;" >
                        <tbody>
                          <tr>
                          <td> <a href="https://www.research.net/r/stormapr2021" class="btn btn-primary py-3 px-4">Sertai Kelas</a> </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </table>
                <table style="border: none; cellpadding: 0; cellspacing: 0;">
                  <tr>
                      <td>
                          <p>Peserta juga boleh klik atau copy link di bawah ke browser yang ingin digunakan <br>
                            https://www.research.net/r/stormapr2021</p>
                      </td>
                  </tr>
                  
                </table>
                {{-- @if($package_name == "General") 
                  <table style="border: none; cellpadding: 0; cellspacing: 0;" class="btn btn-primary">
                    <tr>
                      <td>
                        <p>Jika anda berminat untuk upgrade pakej, sila klik butang di bawah.</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="align-center">
                        <table style="width: 100%; border: none; cellpadding: 0; cellspacing: 0;" >
                          <tbody>
                            <tr>
                            <td> 
                              <a class="btn btn-primary py-3 px-4" href="{{ url('upgrade') }}/{{ $productId }}/{{ $packageId }}/{{ $student_id }}/{{ $payment_id }}/{{ $ticket_id }}">Upgrade Package</a>
                              {{-- <a href="https://order.momentuminternet.com/product/up-gen-storm-2021-24-25-apr-2021-online-flex/" class="btn btn-primary py-3 px-4">Flex</a>
                              <a href="https://order.momentuminternet.com/product/up-gen-storm-2021-24-25-apr-2021-online-vip/" class="btn btn-primary py-3 px-4">VIP</a>
                            </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </table>--}}
                {{-- @elseif($package_name == "Flex") --}}
                  {{-- <table style="border: none; cellpadding: 0; cellspacing: 0;" class="btn btn-primary">
                    <tr>
                      <td>
                        <p>Jika anda berminat untuk upgrade pakej, sila pilih pakej di bawah.</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="align-center">
                        <table style="width: 100%; border: none; cellpadding: 0; cellspacing: 0;" >
                          <tbody>
                            <tr>
                            <td> 
                              <a href="https://order.momentuminternet.com/product/up-flex-storm-2021-24-25-apr-2021-online-vip/" class="btn btn-primary py-3 px-4">Flex</a>
                            </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </table> --}}
                {{-- @elseif($package_name == "VIP")
                @else
                @endif --}}
                <table style="border: none; cellpadding: 0; cellspacing: 0;">
                  
                  <tr>
                    <td>Terima Kasih.
                      <br><br>
                        Salam Kejayaan,<br>
                        <b>Team Momentum.</b>
                    </td>
                  </tr>
                  
                </table>
              </td>
            </tr>

          <!-- END MAIN CONTENT AREA -->
          </table>

          <br>     
          <p>If you received this email by mistake, simply delete it. You won't be subscribed if you don't click the confirmation link above.</p>


          <!-- START FOOTER -->
          <div class="footer">
            <table style="border: none; cellpadding: 0; cellspacing: 0;" >
              {{-- <tr>
                <td class="content-block">
                  <span class="apple-link">Coloured.com.ng | Feminism | Culture | Law | Feminists Rising</span>
                  <br> Don't like these emails? <a href="#">Unsubscribe</a>.
                </td>
              </tr> --}}
              <tr>
                <td class="content-block powered-by">
                  MOMENTUM INTERNET (1079998-A) © 2020 ALL RIGHTS RESERVED​
                </td>
              </tr>
            </table>
          </div>
          <!-- END FOOTER -->
          
        <!-- END CENTERED WHITE CONTAINER -->
        </div>
      </td>
      <td>&nbsp;</td>
    </tr>
  </table>
@endsection