<?php
interface Imetier

{
    public   static  function connect_db();
    public   static  function store(array $data);
    public   static  function delete(int $id);
    public   static  function update(array $data, int  $id);
    public   static  function all(): array;
    public   static  function find(int $id);
    public   static  function findBy(string $condition);
}
