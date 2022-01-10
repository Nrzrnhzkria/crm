@extends('layouts.email')

@section('content')

<style>
    a {
      display : block;
      width:200px;
      height:40px;
  }
  
</style>

    <table style="border: none; cellpadding: 0; cellspacing: 0;" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
            {{-- <span class="preheader">Subscribe to Coloured.com.ng mailing list</span> --}}
            <table class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table style="border: none; cellpadding: 0; cellspacing: 0;" >
                    <tr>
                      <td>
                        <h3>Pendaftaran anda telah berjaya!</h3>
                        <table style="border: none; cellpadding: 0; cellspacing: 0;" class="btn btn-primary">
                          <tbody>
                            <tr>
                                <td>Assalamualaikum & Salam Sejahtera Tuan/Puan,<br><br>
                                Tahniah kerana sudah mendaftar ke Program {{ $product_name }}.
                                Program ini akan berlangsung pada:</td>
                            </tr>
                            <tr>
                                <td>
                                  <b>Tarikh</b> : {{  date('d/m/Y', strtotime($date_from))  }} - {{  date('d/m/Y', strtotime($date_to))  }}<br>
                                  <b>Masa</b> : {{  date('h:i a', strtotime($time_from))  }} - {{  date('h:i a', strtotime($time_to))  }}<br>
                                  <b>Tiket ID</b> : {{ $ticket_id }}<br>
                                  <b>Pakej</b> : {{ $package_name }}
                                </td>
                            </tr>
                            <hr>
                            <tr>
                              <td>                                
                                <p class="align-center">PENTING!</p>
                                <br>
                                <p>1. Anda perlu menjawab soalan kaji selidik ini untuk mendapatkan akses ke platform zoom:</p>
                              </td>
                            </tr>
                            <tr>
                                <td class="align-center">
                                  <a style="font-size:130%;" href="{{ $survey_form }}"> Soalan kaji selidik</a>
                                </td>
                            </tr>
                            <b><p style="font-size: 14px; color:red">*Selepas menjawab soalan kaji selidik, anda akan dibawa ke saluran Telegram khas. Segala maklumat berkaitan program akan dihebahkan di saluran tersebut.</p><b>

                            {{-- For upgrade by ticket --}}
                            <tr>
                              <td>
                                <br>
                                <p>2. Jika anda hendak menaik taraf pakej, sila klik pada butang di bawah:</p>
                              </td>
                            </tr>
                            <tr>
                              <td class="align-center">
                                <a style="font-size:130%; background-color:#FF0000;" href="{{ url('upgrade-ticket') }}/{{ $productId }}/{{ $packageId }}/{{ $ticket_id }}">Naik Taraf</a>
                              </td>
                            </tr>

                            <hr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                        <td>
                          <p>Sekiranya terdapat sebarang pertanyaan atau perlukan bantuan, sila <a href="http://bit.ly/journeymomentuminternet">hubungi kami</a>.</p>
                        </td>
                    </tr>
                    <tr>
                      <td>Terima Kasih
                        <br><br><br>
                          Salam Kejayaan<br>
                          <b>Team Momentum</b>
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