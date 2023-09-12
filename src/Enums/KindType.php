<?php

namespace Mrfansi\Cloudflare\Enums;

enum KindType: string
{
    case IP = 'ip';
    case REDIRECT = 'redirect';
    case HOSTNAME = 'hostname';
    case ASN = 'asn';
}
