// composables/useTruncateBySentence.ts
export const truncateBySentence = (text: string, maxSentences = 1.5): string => {
    const parts = text.split(/(?<=[.?!])\s+/); // split by sentence endings
    if (parts.length <= maxSentences) return text;
    return parts.slice(0, Math.ceil(maxSentences)).join(' ') + '...';
};
