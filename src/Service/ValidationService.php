<?php


namespace Service;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class ValidationService
{
    public function validate(array $data): array
    {
        $validator = Validation::createValidator();
        $constraints = $this->getConstraints();
        $violations = $validator->validate($data, $constraints);

        $errors = [];
        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                $errors[] = $violation->getMessage();
            }
        }
        return $errors;
    }

    public function getConstraints()
    {
        return new Assert\Collection([
            'title' => [
                new Assert\NotBlank(['message' => 'Укажите название поста!']),
                new Assert\Length([
                    'min' => 6,
                    'max' => 255,
                    'minMessage' => 'Длина заголовка должна быть не менее {{ limit }} символов',
                    'maxMessage' => 'Длина заголовка должна быть не более {{ limit }} символов',
                ]),
            ],
            'description' => [
                new Assert\NotBlank(['message' => 'Укажите описание поста!']),
                new Assert\Length([
                    'min' => 10,
                    'max' => 5000,
                    'minMessage' => 'Длина описания должна быть не менее {{ limit }} символов',
                    'maxMessage' => 'Длина описания должна быть не более {{ limit }} символов',
                ])
            ],
        ]);
    }

    public function validateFile(array $file): ?string
    {
        if (!isset($file)) {
            return "Необходимо указать файл!";
        }
        $type = $file['type'];
        $size = $file['size'] / 1024 / 1024;
        if ($size >= 5) {
            return "Максимальный размер файла 5 Mб";
        }
        if (count(array_intersect([$type], [
                'image/jpeg',
                'image/png',
            ])) == 0) {
            return "Поддерживаемый тип данных JPG/PNG!";
        }
        return null;
    }
}
