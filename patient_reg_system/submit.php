<?php

class FormValidator {
    private string $name;
    private string $surname;
    private string $gender;
    private string $birth;
    private string $personalId;
    private string $doctor;
    private string $visit;
    private string $reason;
    public function __construct(string $name, string $surname, string $gender, string $birth,
                                string $personalId, string $doctor, string $visit, string $reason) {
        $this->name = $name;
        $this->surname = $surname;
        $this->gender = $gender;
        $this->birth = $birth;
        $this->personalId = $personalId;
        $this->doctor = $doctor;
        $this->visit = $visit;
        $this->reason = $reason;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getSurname(): string {
        return $this->surname;
    }
    public function getGender(): string {
        return $this->gender;
    }
    public function getBirth(): string {
        return $this->birth;
    }
    public function getPersonalId(): string {
        $pattern = '/[3-6][0-9]{2}[0,1][0-9][0-9]{2}[0-9]{4}/';
        try {
            if (!preg_match($pattern, $this->personalId, $patientList[])) {
                throw new Exception('Personal ID is invalid! Please <a href="index.php">go back</a>');
            } elseif (strlen($this->personalId) > 11) {
                throw new Exception('ID number should consist of 11 digits! Please <a href="index.php">go back</a>');
            }
        } catch (Exception $exception) {
            echo 'Error: '. $exception->getMessage();
            exit();
        }
        return $this->personalId;
    }
    public function getDoctor(): string {
        return $this->doctor;
    }
    public function getVisit(): string {
        $this->visit = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['visit'])->format('Y-m-d H:i');
        try {
            if ($this->visit < date('Y-m-d H:i')) {
                throw new Exception('Choose another date. Please <a href="index.php">go back</a>');
            }
        } catch (Exception $exception) {
            echo 'Error: '. $exception->getMessage();
            exit();
        }
        return $this->visit;
    }
    public function getReason(): string {
        return $this->reason;
    }
}

$formValidator = new FormValidator(
    $_POST['name'],
    $_POST['surname'],
    $_POST['gender'],
    $_POST['birth'],
    $_POST['idNumber'],
    $_POST['doctor'],
    $_POST['visit'],
    $_POST['reason']
);
class PatientData {
    private string $file;
    public function __construct(string $file) {
        $this->file = $file;
    }
    public function addPatient(FormValidator $formValidator): void {
        $oldContent = file_get_contents($this->file);
        $patientList = [];

        if ($patientList !== false) {
            $patientList = json_decode($oldContent, true);
            if ($patientList === null) {
                $patientList = [];
            }
        }

        $id = count($patientList) + 1;

        $patientList[] = [
            'id_row' => $id,
            'name' => $formValidator->getName(),
            'surname' => $formValidator->getSurname(),
            'gender' => $formValidator->getGender(),
            'dob' => $formValidator->getBirth(),
            'id_number' => $formValidator->getPersonalId(),
            'doctor' => $formValidator->getDoctor(),
            'visit' => $formValidator->getVisit(),
            'health_reason' => $formValidator->getReason()
        ];

        $newList = json_encode($patientList, JSON_PRETTY_PRINT);
        file_put_contents($this->file, $newList);
    }
    public function getPatients(): array {
        $content = file_get_contents($this->file);
        $newList = json_decode($content, true);

        return $newList;
    }
}

$patientData = new PatientData('./patient_data.json');
$patientData->addPatient($formValidator);
$patientData->getPatients();

header("Location: data.php");
exit();