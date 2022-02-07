<?php
namespace App\Services;


use Illuminate\Support\Collection;

class BaseService implements IService
{

    /**
     * Property: repo
     * @var mixed
     */
    private $repo;

    public function __construct($repo)
    {
        $this->repo = new $repo;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->repo->all();
    }

    /**
     * @param int $paginate
     *
     * @return mixed
     */
    public function paginate(int $paginate)
    {
        return $this->repo->paginate($paginate);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->repo->findById($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        return $this->repo->destroy($id);
    }

    /**
     * @param array $clause
     * @return mixed
     */
    public function findByClause(array $clause)
    {
        return $this->repo->findByClause($clause);
    }
}
