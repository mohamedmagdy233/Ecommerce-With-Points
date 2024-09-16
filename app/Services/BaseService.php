<?php

namespace App\Services;

use App\Traits\PhotoTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

/**
 * Class BaseService
 * Provides common functionalities to be used by other service classes.
 */
abstract class BaseService
{
    use PhotoTrait;

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseService constructor.
     * @param Model $model The model to be used by the service.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all instances of the model.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return mixed
     */
    public function getDataTable(): mixed
    {
        return $this->model->latest()->get();
    }

    /**
     * Get all instances of the model that match the given conditions.
     *
     * @param array $conditions
     * @return Collection
     */
    public function getWhere(array $conditions): Collection
    {
        $query = $this->model->query();

        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                $query->where($field, $value[0], $value[1]);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->get();
    }

    public function firstWhere(array $conditions): ?Model
    {
        $query = $this->model->query();

        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                $query->where($field, $value[0], $value[1]);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->first();
    }

    /**
     * Get a single instance of the model by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function getById(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }


    public function handleFile($file, $folder = null)
    {
        return $this->saveImage($file, $folder);
    }

    public function handleFiles($files, $folder = null)
    {
        $data = [];
        foreach ($files as $file) {
            $data[] = $this->saveImage($file, $folder);
        }

        return $data;
    }

    /**
     * Create a new instance of the model.
     *
     * @param array $data
     * @return JsonResponse
     */
    public function createData(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing instance of the model.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateData(int $id, array $data)
    {
        $model = $this->getById($id);
        return $model->update($data);
    }

    /**
     * Delete an instance of the model by ID and its associated files.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $model = $this->getById($id);
        if ($model) {
            // Check and delete any associated files
            $this->deleteAssociatedFiles($model);

            // Proceed with model deletion
            $model->delete();
            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 405]);
    }

    public function deleteAll($ids)
    {
        $items = $this->model->whereIn('id', $ids)->get();
        foreach ($items as $item) {
            $this->deleteAssociatedFiles($item);

            $item->delete();
        }
        if ($items) {
            return response()->json(['status' => 200]);
        }

        return response()->json(['status' => 405]);



    }


    protected function deleteAssociatedFiles(Model $model): void
    {
        // Check and delete single image or file
        if (!empty($model->image)) {
            $this->deleteFile($model->image);
        }

        // Check and delete multiple images or files
        $fields = ['images', 'files']; // Adjust according to your model's fields
        foreach ($fields as $field) {
            if (!empty($model->{$field})) {
                foreach ($model->{$field} as $file) {
                    $this->deleteFile($file);
                }
            }
        }
    }

    /**
     * Helper function to delete a file from storage.
     *
     * @param string $filePath
     * @return void
     */
    protected function deleteFile(string $filePath): void
    {
        if (File::exists(public_path($filePath))) {
            File::delete(public_path($filePath));
        }
    }

    /**
     * Get a pluck array from the model based on specified key and value.
     *
     * @param string $keyField The attribute to use as the key.
     * @param string $valueField The attribute to use as the value.
     * @return array
     */
    public function getPluckArray(string $keyField, string $valueField): array
    {
        return $this->model->pluck($valueField, $keyField)->toArray();
    }
}
