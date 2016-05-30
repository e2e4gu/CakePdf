<?php
namespace CakePdf\Pdf\Engine;

class TcpdfEngine extends AbstractPdfEngine
{

    /**
     * Generates Pdf from html
     *
     * @return string raw pdf data
     */
    public function output($filename = '', $dest = 'D')
    {
        //TCPDF often produces a whole bunch of errors, although there is a pdf created when debug = 0
        //Configure::write('debug', 0);
        $TCPDF = new \TCPDF($this->_Pdf->orientation(), 'mm', $this->_Pdf->pageSize());
        $TCPDF->SetPrintHeader(false);
        $TCPDF->SetPrintFooter(false);
        $TCPDF->AddPage();
        // set default font subsetting mode
        $TCPDF->setFontSubsetting(true);

        // set font
        $pathToFontDir = \Cake\Core\Plugin::path('CakePdf') . 'webroot' . DS . 'fonts' . DS . 'tcpdf' . DS;
        $TCPDF->AddFont('source-sans-pro', '', $pathToFontDir . 'source-sans-pro.php');
        $TCPDF->SetFont('source-sans-pro', '', 12);
        $TCPDF->writeHTML($this->_Pdf->html());
        return $TCPDF->Output($filename, $dest);
    }
}

