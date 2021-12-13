<?php

$xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<people xmlns:p="http://example.org/ns" xmlns:t="http://example.org/test">
    <p:person id="1">John Doe</p:person>
    <p:person id="2">Susie Q. Public</p:person>
</people>
XML;

$sxe = new SimpleXMLElement($xml);

$ns = $sxe->getNamespaces(true);

$child = $sxe->children($ns['p']);

foreach ($child->person as $out_ns)
{
    echo $out_ns;
}

?>