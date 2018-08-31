<?php
require dirname(__DIR__) . '/utils.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Converter {
    private function getCoverageTitles() {
		$r = [
			[
				'title' => '$ 10,000',
				'value' => 10000,
				'position' => 'C1'
			],
			[
				'title' => '$ 15,000',
				'value' => 15000,
				'position' => 'O1'
			],
			[
				'title' => '$ 25,000',
				'value' => 25000,
				'position' => 'AA1'
			],
			[
				'title' => '$ 50,000',
				'value' => 50000,
				'position' => 'AM1'
			],
			[
				'title' => '$ 100,000',
				'value' => 100000,
				'position' => 'AY1'
			],
			[
				'title' => '$ 150,000',
				'value' => 150000,
				'position' => 'BK1'
			],
			[
				'title' => '$ 200,000',
				'value' => 200000,
				'position' => 'BW1'
			],
		];

		return $r;
	}

    private function getCoverageStartingPosition($coverageId) {
		switch ($coverageId) {
		case 0:
			return 'C';
			break;
		case 1:
			return 'O';
			break;
		case 2:
			return 'AA';
			break;
		case 3:
			return 'AM';
			break;
		case 4:
			return 'AY';
			break;
		case 5:
			return 'BK';
			break;
		case 6:
			return 'BW';
			break;
		case 7:
			return 'CI';
			break;
		}
    }

    private function getCoverageEndingPosition($coverageId) {
		switch ($coverageId) {
		case 0:
			return 'M';
			break;
		case 1:
			return 'Y';
			break;
		case 2:
			return 'AK';
			break;
		case 3:
			return 'AW';
			break;
		case 4:
			return 'BI';
			break;
		case 5:
			return 'BU';
			break;
		case 6:
			return 'CG';
			break;
		case 7:
			return 'CS';
			break;
		}
    }
    
    private function getCompanies() {
		$r = [];
		$basePath = __DIR__ . DIRECTORY_SEPARATOR;

		$r['manulife']['file'] = $basePath . "ManuLife - Full.xlsx";
		// $r['gms']['file'] = $basePath . "ManuLife - Full.xlsx";
//		$r['tugo']['file'] = $basePath . "ManuLife - Full.xlsx";
//		$r['destination']['file'] = $basePath . "ManuLife - Full.xlsx";
//		$r['twentyfirst']['file'] = $basePath . "ManuLife - Full.xlsx";
		return $r;
	}
	
	private function getActiveFile() {
		$basePath = __DIR__ . DIRECTORY_SEPARATOR;

		// return $basePath . "ManuLife - Full.xlsx";
		// return $basePath . "GMS - Full - Finished.xlsx";
		// return $basePath . "TuGo - Full - Finished.xlsx";
		return $basePath . "21 Century - Full - Finished.xlsx";
		// return $basePath . "Destination - Full - Finished.xlsx";

	}
    
    public function __construct() {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load($this->getActiveFile());
		$company = 'century21';
        $deductibles = [0, 50, 75, 100, 150, 250, 500, 1000, 2500, 5000, 10000];
		$coverageTitles = $this->getCoverageTitles();
		$activeSheet = 3;
		$activeFile = $this->getActiveFile();
		$out = sprintf("\$%s = [\n", $company);

		// Iterate through all coverages
		for ($i = 0; $i < count($coverageTitles) - 1; $i++) {
			// Get coverage position
			$target = $this->getCoverageStartingPosition($i);
			$endTarget = $this->getCoverageEndingPosition($i);

			$out .= sprintf("\t'%s' => [\n\t\t", $spreadsheet->getSheet($activeSheet)->getCell($target . '1')->getCalculatedValue());

			$out .= "[";
			$out .= implode(", ", $deductibles);
			$out .= "],\n";

			for ($j = 0; $j < 92; $j++) {
				$cells = $spreadsheet->getSheet($activeSheet)->rangeToArray($target . ($j + 3) . ':' . $endTarget . ($j + 3));
				$cells = $cells[0];
				$out .= "\t\t[";

				foreach ($cells as &$cell) {
					if (strtolower($cell) == 'n/a') {
						$cell = "'n/a'";
					}
				}

				$out .= implode(', ', $cells);
				$out .= "],\n";
			}

			$out .= "\t],\n";
		}

		$out .= "];";

		file_put_contents($company . '_data_pemc.php', sprintf("<?php\n%s?>", $out));
    }

    public function dd($what) {
        echo '<pre>';
        var_dump($what);
        echo '</pre>';
    }
}

$cnvt = new Converter();
